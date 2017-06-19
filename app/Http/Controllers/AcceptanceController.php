<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

use App\PurchaseOrder;
use App\PurchaseOrdertDetail;
use App\User;
use App\Department;
use App\Item;
use App\Category;
use App\Unit;
use App\Supplier;
use App\Http\Controllers\Controller;

class AcceptanceController extends Controller
{
	
	public function index()
    {
    	$po_nos = PurchaseOrder::all();
    	$departments = Department::all();
    	$users = User::all();

    	$po_header = [];
    	$po_items = [];

		return view("transaction.transaction-acceptance")
				->with("po_header", $po_header)
				->with("po_items", $po_items)
				->with("po_nos", $po_nos)
				->with("departments", $departments)
				->with("users", $users);
    }

    public function store(Request $request) 
    {

    }

    public function get_po(Request $request)
    {
    	$selected_po_no = $request->input('select-po-no');

    	$po_nos = PurchaseOrder::all();
    	$departments = Department::all();
    	$users = User::all();

    	$po_header = \DB::table("purchase_order")
    				->join("agency", "agency.id", "=", "purchase_order.agency_fk")
    				->join("supplier", "supplier.id", "=", "purchase_order.supplier_fk")
    				->select("purchase_order.invoice_date", "purchase_order.supplier_fk", "supplier.supplier_name",
    							"purchase_order.agency_fk", "agency.agency_name")
    				->where("purchase_order.id", $selected_po_no)
    				->first();

    	$po_header->invoice_date = date('F d, Y', strtotime($po_header->invoice_date));

    	$po_items = \DB::table("purchase_order_detail")
    				->join("item", "item.id", "=", "purchase_order_detail.item_fk")
    				->join("unit", "unit.id", "=", "purchase_order_detail.unit_fk")
    				->select("purchase_order_detail.stock_no", "purchase_order_detail.item_fk", "item.item_name",
    							"purchase_order_detail.unit_fk", "unit.unit_name", "purchase_order_detail.quantity",
    							"item.item_description")
    				->where("purchase_order_detail.po_id_fk", $selected_po_no)
    				->get();


    	return view("transaction.transaction-acceptance")
    			->with("po_header", $po_header)
    			->with("po_items", $po_items)
    			->with("po_nos", $po_nos)
				->with("departments", $departments)
				->with("users", $users);
    }



}


