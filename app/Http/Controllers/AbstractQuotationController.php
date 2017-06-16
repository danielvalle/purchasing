<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

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
        $rfq_suppliers = [0 => "", 1 => "", 2 => "", 3 => "", 4 => ""];
        $rfq_items = [];
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
    					->join('request_for_quote_detail', 'request_for_quote.id', '=', 'request_for_quote_detail.request_for_quote_fk')
    					->join('supplier', 'supplier.id', '=', 'request_for_quote.supplier1_fk')
    					->where('request_for_quote.id', $request->input('select-rfq-no'))
    					->pluck('supplier_name');

    	$rfq_supplier_2 = \DB::table('request_for_quote')
    					->join('request_for_quote_detail', 'request_for_quote.id', '=', 'request_for_quote_detail.request_for_quote_fk')
    					->join('supplier', 'supplier.id', '=', 'request_for_quote.supplier2_fk')
    					->where('request_for_quote.id', $request->input('select-rfq-no'))
    					->pluck('supplier_name');

    	$rfq_supplier_3 = \DB::table('request_for_quote')
    					->join('request_for_quote_detail', 'request_for_quote.id', '=', 'request_for_quote_detail.request_for_quote_fk')
    					->join('supplier', 'supplier.id', '=', 'request_for_quote.supplier3_fk')
    					->where('request_for_quote.id', $request->input('select-rfq-no'))
    					->pluck('supplier_name');

    	$rfq_supplier_4 = \DB::table('request_for_quote')
    					->join('request_for_quote_detail', 'request_for_quote.id', '=', 'request_for_quote_detail.request_for_quote_fk')
    					->join('supplier', 'supplier.id', '=', 'request_for_quote.supplier4_fk')
    					->where('request_for_quote.id', $request->input('select-rfq-no'))
    					->pluck('supplier_name');

    	$rfq_supplier_5 = \DB::table('request_for_quote')
    					->join('request_for_quote_detail', 'request_for_quote.id', '=', 'request_for_quote_detail.request_for_quote_fk')
    					->join('supplier', 'supplier.id', '=', 'request_for_quote.supplier5_fk')
    					->where('request_for_quote.id', $request->input('select-rfq-no'))
    					->pluck('supplier_name');

        $rfq_supplier_id_1 = \DB::table('request_for_quote')
                        ->join('request_for_quote_detail', 'request_for_quote.id', '=', 'request_for_quote_detail.request_for_quote_fk')
                        ->join('supplier', 'supplier.id', '=', 'request_for_quote.supplier1_fk')
                        ->where('request_for_quote.id', $request->input('select-rfq-no'))
                        ->pluck('supplier1_fk');

        $rfq_supplier_id_2 = \DB::table('request_for_quote')
                        ->join('request_for_quote_detail', 'request_for_quote.id', '=', 'request_for_quote_detail.request_for_quote_fk')
                        ->join('supplier', 'supplier.id', '=', 'request_for_quote.supplier2_fk')
                        ->where('request_for_quote.id', $request->input('select-rfq-no'))
                        ->pluck('supplier2_fk');

        $rfq_supplier_id_3 = \DB::table('request_for_quote')
                        ->join('request_for_quote_detail', 'request_for_quote.id', '=', 'request_for_quote_detail.request_for_quote_fk')
                        ->join('supplier', 'supplier.id', '=', 'request_for_quote.supplier3_fk')
                        ->where('request_for_quote.id', $request->input('select-rfq-no'))
                        ->pluck('supplier3_fk');

        $rfq_supplier_id_4 = \DB::table('request_for_quote')
                        ->join('request_for_quote_detail', 'request_for_quote.id', '=', 'request_for_quote_detail.request_for_quote_fk')
                        ->join('supplier', 'supplier.id', '=', 'request_for_quote.supplier4_fk')
                        ->where('request_for_quote.id', $request->input('select-rfq-no'))
                        ->pluck('supplier4_fk');

        $rfq_supplier_id_5 = \DB::table('request_for_quote')
                        ->join('request_for_quote_detail', 'request_for_quote.id', '=', 'request_for_quote_detail.request_for_quote_fk')
                        ->join('supplier', 'supplier.id', '=', 'request_for_quote.supplier5_fk')
                        ->where('request_for_quote.id', $request->input('select-rfq-no'))
                        ->pluck('supplier5_fk');                        

    	$rfq_suppliers[0] = $rfq_supplier_1;
    	$rfq_suppliers[1] = $rfq_supplier_2;
    	$rfq_suppliers[2] = $rfq_supplier_3;
    	$rfq_suppliers[3] = $rfq_supplier_4;
    	$rfq_suppliers[4] = $rfq_supplier_5;

        $rfq_suppliers_id[0] = $rfq_supplier_id_1;
        $rfq_suppliers_id[1] = $rfq_supplier_id_2;
        $rfq_suppliers_id[2] = $rfq_supplier_id_3;
        $rfq_suppliers_id[3] = $rfq_supplier_id_4;
        $rfq_suppliers_id[4] = $rfq_supplier_id_5;

        session(['aq_rfq_no' => $request->input('select-rfq-no')]);
        session(['aq_suppliers' => $rfq_suppliers]);
        session(['aq_suppliers_id' => $rfq_suppliers_id]);
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
        $suppliers_id = session()->get('aq_suppliers_id');
        $items = session()->get('aq_rfq_items');
        dd($items);
        $abstract_quotation = AbstractQuotation::create(array(
                'date' => date("Y-m-d", strtotime($request->input('transaction_date'))),
                'supplier1_fk' => $suppliers_id[0],
                'supplier2_fk' => $suppliers_id[1],
                'supplier3_fk' => $suppliers_id[2],
                'supplier4_fk' => $suppliers_id[3],
                'supplier5_fk' => $suppliers_id[4],
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
                    'quantity' => $items[$i]->quantity,
                    'is_active' => 1
            ));        

            $abstract_quotation_detail->save();

        }

        return redirect("transaction/abstract-quotation");
    }

}


