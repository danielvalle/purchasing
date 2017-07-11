<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use PDF;

use App\AbstractQuotation;
use App\AbstractQuotationDetail;
use App\PurchaseRequest;
use App\PurchaseRequestDetail;
use App\RequestForQuote;
use App\RequestForQuoteDetail;
use App\User;
use App\Item;
use App\Category;
use App\Unit;
use App\Supplier;
use App\Http\Controllers\Controller;

class AbstractQuotationController extends Controller
{
    
    public function index()
    {

    	$rfqs = RequestForQuote::all();
        $rfq_suppliers = [];
        $rfq_items = [];

        session(['aq_rfq_no' => null]);
        session(['aq_suppliers' => null]);
        session(['aq_suppliers_id' => null]);
        session(['aq_rfq_items' => null]);

        $users = User::all();

        return view("transaction.transaction-abstract-quotation")
        	->with("rfqs", $rfqs)
            ->with("rfq_suppliers", $rfq_suppliers)
            ->with("rfq_items", $rfq_items)
            ->with("users", $users);
    }


    public function get_rfq(Request $request)
    {
        
    	$rfqs = RequestForQuote::all();
        $users = User::all();

    	$rfq_items = \DB::table('request_for_quote')
    					->join('request_for_quote_detail', 'request_for_quote.id', '=', 'request_for_quote_detail.request_for_quote_fk')
    					->join('item', 'request_for_quote_detail.item_fk', '=', 'item.id')
    					->join('unit', 'request_for_quote_detail.unit_fk', '=', 'unit.id')
    					->select('request_for_quote.*', 'request_for_quote_detail.*', 'item.*', 'unit.*',
    							'request_for_quote.id AS rfq_id', 'request_for_quote_detail.id AS rfqd_id',
    							'item.id AS item_id', 'unit.id AS unit_ID')
    					->where('request_for_quote_detail.request_for_quote_fk', $request->input('select-rfq-no'))
    					->get();


    	$rfq_supplier_1 = \DB::table('request_for_quote')
    					->join('supplier', 'supplier.id', '=', 'request_for_quote.supplier1_fk')
    					->select('supplier_name', 'supplier1_fk as id')
                        ->where('request_for_quote.id', $request->input('select-rfq-no'))
                        ->get();

    	$rfq_supplier_2 = \DB::table('request_for_quote')
    					->join('supplier', 'supplier.id', '=', 'request_for_quote.supplier2_fk')
    					->select('supplier_name', 'supplier2_fk as id')
                        ->where('request_for_quote.id', $request->input('select-rfq-no'))
                        ->get();

    	$rfq_supplier_3 = \DB::table('request_for_quote')
    					->join('supplier', 'supplier.id', '=', 'request_for_quote.supplier3_fk')
    					->select('supplier_name', 'supplier3_fk as id')
                        ->where('request_for_quote.id', $request->input('select-rfq-no'))
                        ->get();

    	$rfq_supplier_4 = \DB::table('request_for_quote')
    					->join('supplier', 'supplier.id', '=', 'request_for_quote.supplier4_fk')
    					->select('supplier_name', 'supplier4_fk as id')
                        ->where('request_for_quote.id', $request->input('select-rfq-no'))
                        ->get();

    	$rfq_supplier_5 = \DB::table('request_for_quote')
    					->join('supplier', 'supplier.id', '=', 'request_for_quote.supplier5_fk')
    					->select('supplier_name', 'supplier5_fk as id')
                        ->where('request_for_quote.id', $request->input('select-rfq-no'))
                        ->get();

    	$rfq_suppliers[0] = $rfq_supplier_1;
    	$rfq_suppliers[1] = $rfq_supplier_2;
    	$rfq_suppliers[2] = $rfq_supplier_3;
    	$rfq_suppliers[3] = $rfq_supplier_4;
    	$rfq_suppliers[4] = $rfq_supplier_5;

        $rfq_suppliers = array_reduce($rfq_suppliers, 'array_merge', array());

        session(['aq_rfq_no' => $request->input('select-rfq-no')]);
        session(['aq_suppliers' => $rfq_suppliers]);
        session(['aq_rfq_items' => $rfq_items]);

    	return view("transaction.transaction-abstract-quotation")
    		->with("rfqs", $rfqs)
        	->with("rfq_suppliers", $rfq_suppliers)
            ->with("rfq_items", $rfq_items)
            ->with("users", $users);
    }


    public function store(Request $request) 
    {
        $suppliers = session()->get('aq_suppliers');
        $items = session()->get('aq_rfq_items');
        

        for($i = 0; $i < count($items); $i++)
        {
            $winners[] = explode(",",$request->input('add-winner-supplier' . $i));
        }
     

        if($items == null)
        {
            \Session::flash('aq_add_fail','You have not selected a Request For Quotation. Abstract Quotation is not sent.');
            
            return redirect('transaction/abstract-quotation');
        }
        else
        {
            $abstract_quotation = AbstractQuotation::create(array(
                    'date' => date("Y-m-d", strtotime($request->input('transaction_date'))),
                    'supplier1_fk' => array_key_exists(0, $suppliers) == true ? $suppliers[0]->id : null,
                    'supplier2_fk' => array_key_exists(1, $suppliers) == true ? $suppliers[1]->id : null,
                    'supplier3_fk' => array_key_exists(2, $suppliers) == true ? $suppliers[2]->id : null,
                    'supplier4_fk' => array_key_exists(3, $suppliers) == true ? $suppliers[3]->id : null,
                    'supplier5_fk' => array_key_exists(4, $suppliers) == true ? $suppliers[4]->id : null,
                    'supervising_admin_fk' => $request->input("add-supervising-admin"),
                    'admin_officer_fk' => $request->input("add-admin-officer"),
                    'admin_officer_2_fk' => $request->input("add-admin-officer-2"),
                    'board_secretary_fk' => $request->input("add-board-secretary"),
                    'vpaf_fk' => $request->input("add-vpaf"),
                    'approve_fk' => $request->input("add-approved-by"),
                    'pr_fk' => $request->input("add-pr-fk"),
                    'is_active' => 1
            ));

            $abstract_quotation->save();

            $abstract_quotation = AbstractQuotation::find($abstract_quotation->id);

            $abstract_quotation->aq_number = date("Y-m", strtotime($abstract_quotation->date)) . "-" . sprintf("%04d", $abstract_quotation->id);
            $abstract_quotation->save();

            session(["pdf_aq_id" => $abstract_quotation->id]);

            for($i = 0; $i < count($items); $i++){

                $abstract_quotation_detail = AbstractQuotationDetail::create(array(
                        'abstract_quotation_fk' => $abstract_quotation->id,
                        'unit_fk' => $items[$i]->unit_fk,
                        'item_fk' => $items[$i]->item_fk    ,
                        'supplier1_amount' => $request->input('supplier1_amount' . $i),
                        'supplier2_amount' => $request->input('supplier2_amount' . $i),
                        'supplier3_amount' => $request->input('supplier3_amount' . $i),
                        'supplier4_amount' => $request->input('supplier4_amount' . $i),
                        'supplier5_amount' => $request->input('supplier5_amount' . $i),
                        'winning_supplier_fk' => $winners[$i][0],
                        'winning_supplier_amount' => $request->input('supplier'. ($winners[$i][1] + 1) . '_amount' . $i),
                        'quantity' => $items[$i]->quantity,
                        'is_active' => 1
                ));        

                $abstract_quotation_detail->save();

            }

            \Session::flash('aq_add_success','Abstract Quotation is successfully sent. Reference No. is AQ No. ' . $abstract_quotation->aq_number);

            \Session::flash('aq_new_check','yes');

            return redirect("transaction/abstract-quotation");
            
        }
    }

    public function aq_pdf()
    {
        $header = \DB::table('abstract_quotation')
                ->select("*")
                ->where("id", session()->get("pdf_aq_id"))
                ->first();

        $supplier1 = \DB::table("abstract_quotation AS aq")
                ->leftJoin("supplier AS s", "aq.supplier1_fk", "=", "s.id")
                ->select("s.supplier_name")
                ->where("aq.id", session()->get("pdf_aq_id"))
                ->first();

        $supplier2 = \DB::table("abstract_quotation AS aq")
                ->leftJoin("supplier AS s", "aq.supplier2_fk", "=", "s.id")
                ->select("s.supplier_name")
                ->where("aq.id", session()->get("pdf_aq_id"))
                ->first();

        $supplier3 = \DB::table("abstract_quotation AS aq")
                ->leftJoin("supplier AS s", "aq.supplier3_fk", "=", "s.id")
                ->select("s.supplier_name")
                ->where("aq.id", session()->get("pdf_aq_id"))
                ->first();

        $supplier4 = \DB::table("abstract_quotation AS aq")
                ->leftJoin("supplier AS s", "aq.supplier4_fk", "=", "s.id")
                ->select("s.supplier_name")
                ->where("aq.id", session()->get("pdf_aq_id"))
                ->first();

        $supplier5 = \DB::table("abstract_quotation AS aq")
                ->leftJoin("supplier AS s", "aq.supplier5_fk", "=", "s.id")
                ->select("s.supplier_name")
                ->where("aq.id", session()->get("pdf_aq_id"))
                ->first();

        $aq_supervising_admin = \DB::table("abstract_quotation AS aq")
                ->leftJoin("user", "aq.supervising_admin_fk", "=", "user.id")
                ->select("user.first_name", "user.middle_name", "user.last_name")
                ->where("aq.id", session()->get("pdf_aq_id"))
                ->first();

        $aq_admin_officer = \DB::table("abstract_quotation AS aq")
                ->leftJoin("user", "aq.admin_officer_fk", "=", "user.id")
                ->select("user.first_name", "user.middle_name", "user.last_name")
                ->where("aq.id", session()->get("pdf_aq_id"))
                ->first();

        $aq_admin_officer_2 = \DB::table("abstract_quotation AS aq")
                ->leftJoin("user", "aq.admin_officer_2_fk", "=", "user.id")
                ->select("user.first_name", "user.middle_name", "user.last_name")
                ->where("aq.id", session()->get("pdf_aq_id"))
                ->first();

        $aq_board_secretary = \DB::table("abstract_quotation AS aq")
                ->leftJoin("user", "aq.board_secretary_fk", "=", "user.id")
                ->select("user.first_name", "user.middle_name", "user.last_name")
                ->where("aq.id", session()->get("pdf_aq_id"))
                ->first();

        $aq_vpaf = \DB::table("abstract_quotation AS aq")
                ->leftJoin("user", "aq.vpaf_fk", "=", "user.id")
                ->select("user.first_name", "user.middle_name", "user.last_name")
                ->where("aq.id", session()->get("pdf_aq_id"))
                ->first();

        $aq_approve = \DB::table("abstract_quotation AS aq")
                ->leftJoin("user", "aq.approve_fk", "=", "user.id")
                ->select("user.first_name", "user.middle_name", "user.last_name")
                ->where("aq.id", session()->get("pdf_aq_id"))
                ->first();

        $items = \DB::table("abstract_quotation_detail AS aqd")
                ->leftJoin("item", "aqd.item_fk", "=", "item.id")
                ->leftJoin("unit", "aqd.unit_fk", "=", "unit.id")
                ->select("item.item_name", "unit.unit_name", "aqd.quantity", "item.stock_no",
                         "aqd.supplier1_amount", "aqd.supplier2_amount", "aqd.supplier3_amount",
                         "aqd.supplier4_amount", "aqd.supplier5_amount")
                ->where("aqd.abstract_quotation_fk", session()->get("pdf_aq_id"))
                ->get();

        view()->share('header', $header);

        view()->share('supplier1', $supplier1);
        view()->share('supplier2', $supplier2);
        view()->share('supplier3', $supplier3);
        view()->share('supplier4', $supplier4);
        view()->share('supplier5', $supplier5);
        
        view()->share('aq_supervising_admin', $aq_supervising_admin);
        view()->share('aq_admin_officer', $aq_admin_officer);
        view()->share('aq_admin_officer_2', $aq_admin_officer_2);
        view()->share('aq_board_secretary', $aq_board_secretary);
        view()->share('aq_vpaf', $aq_vpaf);
        view()->share('aq_approve', $aq_approve);

        view()->share('items', $items);

        $pdf = PDF::loadView('pdf.abstract-quotation-pdf');
        return $pdf->download('AQ' . $header->aq_number . '.pdf');
    }    


}


