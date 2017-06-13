<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

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
    					->where('request_for_quote.id', $request->input('select-rfq-no'))
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

    	$rfq_suppliers[0] = $rfq_supplier_1;
    	$rfq_suppliers[1] = $rfq_supplier_2;
    	$rfq_suppliers[2] = $rfq_supplier_3;
    	$rfq_suppliers[3] = $rfq_supplier_4;
    	$rfq_suppliers[4] = $rfq_supplier_5;
        
        session(['aq_rfq_no' => $request->input('select-rfq-no')]);

    	return view("transaction.transaction-abstract-quotation")
    		->with("rfqs", $rfqs)
        	->with("rfq_suppliers", $rfq_suppliers)
            ->with("rfq_items", $rfq_items)
            ->with("users", $users);
    }


    public function store(Request $request) 
    {

    }

}


