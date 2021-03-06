<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use PDF;

use App\Entity;
use App\PurchaseRequest;
use App\PurchaseRequestDetail;
use App\RequestForQuote;
use App\RequestForQuoteDetail;
use App\AbstractQuotation;
use App\AbstractQuotationDetail;
use App\PurchaseOrder;
use App\PurchaseOrderDetail;
use App\Supplier;
use App\User;
use App\Designation;
use App\Item;
use App\Category;
use App\Unit;
use App\Http\Controllers\Controller;

class PurchaseOrderController extends Controller
{
    
    public function index()
    {
    	$entities = Entity::all();
    	$users = User::all();
        $designations = Designation::all();
        $pr_nos = \DB::table('purchase_request')
                        ->select('*')
                        ->where('is_active', '!=', '2')
                        ->get();
        $selected_pr_no = "";
        $selected_aq_no = "";
        $selected_supplier = "";

        $total = "";

        $items = [];

        return view("transaction.transaction-purchase-order")
            ->with("selected_pr_no", $selected_pr_no)
            ->with("selected_aq_no", $selected_aq_no)
        	->with("entities", $entities)
        	->with("users", $users)
            ->with("designations", $designations)
            ->with("pr_nos", $pr_nos)
            ->with("selected_supplier", $selected_supplier)
            ->with("total", $total)
            ->with("items", $items);
    }

    public function store(Request $request) 
    {
        $items = session()->get("po_items");
        $supplier_amounts = $request->input('supplier-amount');
        $aqd_ids = $request->input('aqd-id');

        if($items == null)
        {
            \Session::flash('po_add_fail','You have not selected a Purchase Request. Purchase Order is not sent.');
            
            return redirect('transaction/purchase-order');
        }
        else
        {

            $purchase_order = PurchaseOrder::create(array(
                    'supplier_fk' => session()->get('po_supplier'),
                    'address' => $request->input('add-address'),
                    'tin' => $request->input('add-tin'),
                    'invoice_date' =>  $request->input('add-date') != '' ? date("Y-m-d", strtotime($request->input('add-date'))) : null,
                    'mode_of_procurement' => $request->input('add-mode-of-procurement'),
                    'place_of_delivery' => $request->input('add-place-delivery'),
                    'date_of_delivery' =>  $request->input('add-date-delivery'),
                    'delivery_term' => $request->input('add-delivery-term'),
                    'payment_term' => $request->input('add-payment-term'),
                    'authorized_official_fk' => $request->input('add-authorized-official'),
                    'authorized_official_designation_fk' => $request->input('add-authorized-official-designation'),
                    'funds_available' => $request->input('add-funds-available'),
                    'total_amount' => $request->input('add-total-amount'),
                    'total_amount_in_words' => $request->input('add-total-words'),
                    'alobs_bub_no' => $request->input('add-alobs-no'),
                    'pr_no_fk' => $request->input('hdn-pr-no'),
                    'abstract_quotation_fk' => $request->input('hdn-aq-no'),
                    'is_active' => 1
                ));

            $purchase_order->save();

            $purchase_order = PurchaseOrder::find($purchase_order->id);

            $purchase_order->po_number = date("Y-m") . "-" . sprintf("%04d", $purchase_order->id);
            $purchase_order->save();

            for($i = 0; $i < count($aqd_ids); $i++){

                $aqd = AbstractQuotationDetail::find($aqd_ids[$i]);        
                $aqd->is_active = 0;
                $aqd->save();
            }

            $aq_supplier = \DB::table('abstract_quotation_detail as aqd')
                        ->join('abstract_quotation as aq', 'abstract_quotation_fk', '=', 'aq.id')
                        ->join('supplier', 'supplier.id', '=', 'aqd.winning_supplier_fk')
                        ->distinct()
                        ->select('supplier_name', 'supplier.id as supp_id')
                        ->where('aq.pr_fk', $request->input('hdn-pr-no'))
                        ->where('aqd.is_active', '1')
                        ->get();

            if($aq_supplier == null)
            {
                $pr = PurchaseRequest::find($request->input('hdn-pr-no'));
                $pr->is_active = 2;
                $pr->save(); 
            }
            
            session(["pdf_po_id" => $purchase_order->id]);

            for($i = 0; $i < count($items); $i++){

                $purchase_order_detail = PurchaseOrderDetail::create(array(
                        'po_id_fk' => $purchase_order->id,
                        'stock_no' => $items[$i]->stock_no,
                        'unit_fk' => $items[$i]->unit_fk,
                        'item_fk' => $items[$i]->item_fk,
                        'quantity' => $items[$i]->quantity,
                        'unit_cost' => $items[$i]->winning_supplier_amount,
                        'amount' => $items[$i]->total
                ));
                
                $purchase_order_detail->save();

            }

            \Session::flash('po_add_success','Purchase Order is successfully sent. Reference No. is PO No. ' . $purchase_order->po_number);

            \Session::flash('po_new_check','yes');

            return redirect("transaction/purchase-order");

        }
    }

    public function get_aq(Request $request)
    {
        $entities = Entity::all();
        $users = User::all();
        $designations = Designation::all();
        $pr_nos = \DB::table('purchase_request')
                        ->select('*')
                        ->where('is_active', '!=', '2')
                        ->get();
        $selected_pr_no = $request->input('select-pr-no');
        $selected_supplier = $request->input('add-supplier');

        $selected_aq_no = "";
        $items = [];

        $total = 0;

        if($selected_pr_no == null)
        {
            Session::flash('pr_select_fail', 'You have not selected a Purchase Request Number.');   
        }
        else
        {
            $selected_aq = AbstractQuotation::where("pr_fk", $selected_pr_no)->first();
        
            if($selected_aq == null)
            {
                Session::flash('aq_select_fail', 'You have not selected a Purchase Request Number.');
            }
            else
            {
                $selected_aq_no = $selected_aq->id;

                $suppliers[0] = $selected_aq->supplier1_fk;
                $suppliers[1] = $selected_aq->supplier2_fk;
                $suppliers[2] = $selected_aq->supplier3_fk;
                $suppliers[3] = $selected_aq->supplier4_fk;
                $suppliers[4] = $selected_aq->supplier5_fk;

                $suppliers = array_values(array_filter($suppliers)); 

                session(['po_suppliers' => $suppliers]); 

                $temp_supplier_names = \DB::table("supplier")
                                ->select("supplier_name")
                                ->whereIn("id", $suppliers)
                                ->get();

                for($i = 0; $i < count($suppliers); $i++) $supplier_names[$i] = $temp_supplier_names[$i]->supplier_name;           

                $items = \DB::table("abstract_quotation as aq")
                        ->leftJoin("abstract_quotation_detail AS aqd", "aq.id", "=", "aqd.abstract_quotation_fk")
                        ->leftJoin("item", "item.id", "=", "aqd.item_fk")
                        ->leftJoin("unit", "unit.id", "=", "aqd.unit_fk")
                        ->distinct()
                        ->select("aqd.id as aqd_id", "aqd.item_fk", "aqd.unit_fk", "item.stock_no", "aqd.quantity", "unit.unit_name", "item.item_name",
                                 "aqd.winning_supplier_amount", \DB::raw('aqd.winning_supplier_amount * aqd.quantity as total'))
                        ->where("aq.pr_fk", $selected_pr_no)
                        ->where("aqd.winning_supplier_fk", $selected_supplier)
                        ->get();

                foreach($items as $item) $total += $item->total;

                session(['po_items' => $items]);
                session(['po_supplier' => $selected_supplier]);

                if($items == null) Session::flash('aq_supplier_fail', 'There are no items for the Purchase Request under that supplier.');
            }
        }

        return view("transaction.transaction-purchase-order")
            ->with("selected_pr_no", $selected_pr_no)
            ->with("selected_aq_no", $selected_aq_no)
            ->with("entities", $entities)
            ->with("users", $users)
            ->with("designations", $designations)
            ->with("pr_nos", $pr_nos)
            ->with("selected_supplier", $selected_supplier)
            ->with("total", $total)
            ->with("items", $items);
    }

    public function get_supplier(Request $request)
    {

        $aq_supplier = \DB::table('abstract_quotation_detail as aqd')
                        ->join('abstract_quotation as aq', 'abstract_quotation_fk', '=', 'aq.id')
                        ->join('supplier', 'supplier.id', '=', 'aqd.winning_supplier_fk')
                        ->distinct()
                        ->select('supplier_name', 'supplier.id as id')
                        ->where('aq.pr_fk', $request->input('id'))
                        ->where('aqd.is_active', '1')
                        ->get();

        
        if($request->ajax()){

            return response()->json(array(
                    'suppliers' => $aq_supplier
                ));
        }


    }

    public function po_pdf()
    {
        $po_header = \DB::table('purchase_order AS po')
                ->leftJoin("supplier AS s", "po.supplier_fk", "=", "s.id")
                ->leftJoin("user AS u", "po.authorized_official_fk", "=", "u.id")
                ->leftJoin("designation as d", "po.authorized_official_designation_fk", "=", "d.id")
                ->select("s.supplier_name", "po.address", "po.tin", "po.po_number", "po.pr_no_fk", "po.funds_available",
                         "po.invoice_date", "po.mode_of_procurement", "po.place_of_delivery", "po.total_amount_in_words",
                         "po.delivery_term", "po.date_of_delivery", "po.payment_term", "po.total_amount",
                         "u.first_name", "u.middle_name", "u.last_name", "d.designation_name")
                ->where("po.id", session()->get('pdf_po_id'))
                ->first();

        $pr = \DB::table('purchase_request')
                ->leftJoin('entity', 'entity.id', '=', 'purchase_request.entity_fk')
                ->select('entity.entity_name', 'purchase_request.fund_cluster')
                ->where('purchase_request.id', $po_header->pr_no_fk)->first();

        $items = \DB::table('purchase_order_detail AS pod')
                ->leftJoin("item AS i", "pod.item_fk", "=", "i.id")
                ->leftJoin("unit AS u", "pod.unit_fk", "=", "u.id")
                ->select("pod.stock_no", "u.unit_name", "i.item_name", "pod.quantity",
                         "pod.unit_cost", "pod.amount")
                ->where("pod.po_id_fk", session()->get('pdf_po_id'))
                ->get();

        view()->share('po_header', $po_header);
        view()->share('pr', $pr);
        view()->share('items', $items);

        $pdf = PDF::loadView('pdf.purchase-order-pdf');
        return $pdf->download('PO' . $po_header->po_number . '.pdf');
    }


}


