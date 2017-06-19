<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

use App\Agency;
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
use App\Item;
use App\Category;
use App\Unit;
use App\Http\Controllers\Controller;

class PurchaseOrderController extends Controller
{
    
    public function index()
    {
    	$agencies = Agency::all();
    	$users = User::all();
        $pr_nos = PurchaseRequest::all();
        $selected_pr_no = "";
        $selected_aq_no = "";

        $suppliers = [];
        $supplier_names = [];
        $items = [];

        return view("transaction.transaction-purchase-order")
            ->with("selected_pr_no", $selected_pr_no)
            ->with("selected_aq_no", $selected_aq_no)
        	->with("agencies", $agencies)
        	->with("users", $users)
            ->with("pr_nos", $pr_nos)
            ->with("suppliers", $suppliers)
            ->with("supplier_names", $supplier_names)
            ->with("items", $items);
    }

    public function store(Request $request) 
    {
        $items = session()->get("po_items");
        $supplier_amounts = $request->input('supplier-amount');

        $purchase_order = PurchaseOrder::create(array(
                'agency_fk' => $request->input('add-agency'),
                'supplier_fk' => $request->input('add-supplier'),
                'address' => $request->input('add-address'),
                'tin' => $request->input('add-tin'),
                'invoice_date' =>  date("Y-m-d", strtotime($request->input('add-date'))),
                'mode_of_procurement' => $request->input('add-mode-of-procurement'),
                'place_of_delivery' => $request->input('add-place-delivery'),
                'date_of_delivery' =>  date("Y-m-d", strtotime($request->input('add-date-delivery'))),
                'delivery_term' => $request->input('add-delivery-term'),
                'payment_term' => $request->input('add-payment-term'),
                'authorized_official_fk' => $request->input('add-authorized-official'),
                'total_amount' => $request->input('add-total-amount'),
                'alobs_bub_no' => $request->input('add-alobs-no'),
                'pr_no_fk' => $request->input('hdn-pr-no'),
                'abstract_quotation_fk' => $request->input('hdn-aq-no'),
                'is_active' => 1
            ));

        $purchase_order->save();

        $purchase_order = PurchaseOrder::find($purchase_order->id);

        $purchase_order->po_no = date("Y-m", strtotime($purchase_order->date)) . "-" . sprintf("%04d", $purchase_order->id);
        $purchase_order->save();

        for($i = 0; $i < count($items); $i++){

            $purchase_order_detail = PurchaseOrderDetail::create(array(
                    'po_id_fk' => $purchase_order->id,
                    'stock_no' => $items[$i]->stock_no,
                    'unit_fk' => $items[$i]->unit_of_issue_fk,
                    'item_fk' => $items[$i]->item_fk,
                    'category_fk' => $items[$i]->category_fk,
                    'quantity' => $items[$i]->quantity,
                    'unit_cost' => $supplier_amounts[$i],
                    'amount' => $items[$i]->quantity * ((int)$supplier_amounts[$i])
            ));
            
            $purchase_order_detail->save();

        }

        return redirect("transaction/purchase-order");
    }

    public function get_aq(Request $request)
    {
        $agencies = Agency::all();
        $users = User::all();
        $pr_nos = PurchaseRequest::all();
        $selected_pr_no = $request->input('select-pr-no');

        $selected_aq = AbstractQuotation::where("pr_fk", $selected_pr_no)->first();
        
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

        $items = \DB::table("purchase_request")
                ->join("purchase_request_detail AS prd", "purchase_request.id", "=", "prd.purchase_request_fk")
                ->join("item", "item.id", "=", "prd.item_fk")
                ->join("unit", "unit.id", "=", "prd.unit_of_issue_fk")
                ->select("prd.item_fk", "prd.unit_of_issue_fk", "prd.category_fk", "prd.stock_no", "prd.quantity", "unit.unit_name", "item.item_name")
                ->where("prd.purchase_request_fk", $selected_pr_no)
                ->get();

        session(['po_items' => $items]);

        return view("transaction.transaction-purchase-order")
            ->with("selected_pr_no", $selected_pr_no)
            ->with("selected_aq_no", $selected_aq_no)
            ->with("agencies", $agencies)
            ->with("users", $users)
            ->with("pr_nos", $pr_nos)
            ->with("suppliers", $suppliers)
            ->with("supplier_names", $supplier_names)
            ->with("items", $items);
        /*$suppliers = \DB::table("abstract_quotation")
                ->join("abstract_quotation_detail", "abstract_quotation.id", "=", "abstract_quotation_detail.abstract_quotation_fk")
                ->*/
    }

    public function select_supplier(Request $request)
    {       

        $suppliers = session()->get('po_suppliers');

        $temp_supplier_amounts = \DB::table("abstract_quotation AS aq")
                            ->join("abstract_quotation_detail AS aqd", "aq.id", "=", "aqd.abstract_quotation_fk")
                            ->select("aqd.*")
                            ->where("aq.pr_fk", $request->input('pr_no'))
                            ->get();

        for($i = 0; $i < count($suppliers); $i++)
        {
            for($j = 0; $j < count($temp_supplier_amounts); $j++)
            {
                if($i == 0) $supplier_amounts[$suppliers[$i]][$j] = $temp_supplier_amounts[$j]->supplier1_amount;
                if($i == 1) $supplier_amounts[$suppliers[$i]][$j] = $temp_supplier_amounts[$j]->supplier2_amount;
                if($i == 2) $supplier_amounts[$suppliers[$i]][$j] = $temp_supplier_amounts[$j]->supplier3_amount;
                if($i == 3) $supplier_amounts[$suppliers[$i]][$j] = $temp_supplier_amounts[$j]->supplier4_amount;
                if($i == 4) $supplier_amounts[$suppliers[$i]][$j] = $temp_supplier_amounts[$j]->supplier5_amount;
            }
        }        

        if($request->ajax()){

            return response()->json(array(
                    'amount' => $supplier_amounts[$request->input('id')]
                ));
        }
        
    }

}


