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

        $suppliers = [];
        $supplier_names = [];
        $items = [];

        return view("transaction.transaction-purchase-order")
            ->with("selected_pr_no", $selected_pr_no)
        	->with("agencies", $agencies)
        	->with("users", $users)
            ->with("pr_nos", $pr_nos)
            ->with("suppliers", $suppliers)
            ->with("supplier_names", $supplier_names)
            ->with("items", $items);
    }

    public function store(Request $request) 
    {

    }

    public function get_aq(Request $request)
    {
        $agencies = Agency::all();
        $users = User::all();
        $pr_nos = PurchaseRequest::all();
        $selected_pr_no = $request->input('select-pr-no');

        $temp_suppliers = AbstractQuotation::where("pr_fk", $selected_pr_no)->first();
        
        $suppliers[0] = $temp_suppliers->supplier1_fk;
        $suppliers[1] = $temp_suppliers->supplier2_fk;
        $suppliers[2] = $temp_suppliers->supplier3_fk;
        $suppliers[3] = $temp_suppliers->supplier4_fk;
        $suppliers[4] = $temp_suppliers->supplier5_fk;

        $suppliers = array_values(array_filter($suppliers)); 

        $temp_supplier_amounts = \DB::table("abstract_quotation AS aq")
                            ->join("abstract_quotation_detail AS aqd", "aq.id", "=", "aqd.abstract_quotation_fk")
                            ->select("aqd.*")
                            ->where("aq.pr_fk", $selected_pr_no)
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

        $temp_supplier_names = \DB::table("supplier")
                        ->select("supplier_name")
                        ->whereIn("id", $suppliers)
                        ->get();

        for($i = 0; $i < count($suppliers); $i++) $supplier_names[$i] = $temp_supplier_names[$i]->supplier_name;           

        $items = \DB::table("purchase_request")
                ->join("purchase_request_detail AS prd", "purchase_request.id", "=", "prd.purchase_request_fk")
                ->join("item", "item.id", "=", "prd.item_fk")
                ->join("unit", "unit.id", "=", "prd.unit_of_issue_fk")
                ->select("prd.item_fk", "prd.stock_no", "prd.quantity", "unit.unit_name", "item.item_name")
                ->where("prd.purchase_request_fk", $selected_pr_no)
                ->get();

        return view("transaction.transaction-purchase-order")
            ->with("selected_pr_no", $selected_pr_no)
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
        dd($request->input('id'));
        $request->session()->push('temp_suppliers', $request->input('id'));

        if($request->ajax()){

            return $request->all();
        }
        
    }

}


