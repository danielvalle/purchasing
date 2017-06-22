<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

use App\PurchaseOrder;
use App\PurchaseOrderDetail;
use App\Acceptance;
use App\AcceptanceDetail;
use App\User;
use App\Department;
use App\Item;
use App\Category;
use App\Unit;
use App\Supplier;
use App\StockCard;
use App\Http\Controllers\Controller;

class AcceptanceController extends Controller
{
	
	public function index()
    {
    	$po_nos = PurchaseOrder::all();
    	$departments = Department::all();
    	$users = User::all();

    	$po_date = "";
        $po_supplier_fk = "";
        $po_supplier_name = "";
        $po_agency_fk = "";
        $po_agency_name = "";
        $po_no = "";

    	$po_items = [];

		return view("transaction.transaction-acceptance")
                ->with("po_number", $po_no)
				->with("po_date", $po_date)
                ->with("po_supplier_fk", $po_supplier_fk)
                ->with("po_supplier_name", $po_supplier_name)
                ->with("po_agency_fk", $po_agency_fk)
                ->with("po_agency_name", $po_agency_name)
				->with("po_items", $po_items)
				->with("po_nos", $po_nos)
				->with("departments", $departments)
				->with("users", $users);
    }
    public function store(Request $request) 
    {
        $items = session()->get("acceptance_items");

        $acceptance = Acceptance::create(array(
                'agency_fk' => $request->input('add-agency'),
                'supplier_fk' => $request->input('add-supplier'),
                'po_fk' => session()->get("acceptance_po_no"),
                'po_no' => $request->input('add-po-no'),
                'po_date' => $request->input('add-po-date'),
                'iar' => $request->input('add-iar'),
                'invoice_no' => $request->input('add-invoice-no'),
                'invoice_date' =>  date("Y-m-d", strtotime($request->input('add-invoice-date'))),
                'requisitioning_dept_fk' => $request->input('select-dept'),
                'date_inspected' => $request->input('cbx-inspected'),
                'verification' =>  $request->input('add-date-delivery'),
                'inspector_fk' => $request->input('add-inspector'),
                'date_accepted' => $request->input('add-date-accepted'),
                'completeness' => $request->input('rdb-completeness'),
                'property_officer_fk' => $request->input('add-officer'),
                'is_active' => 1
            ));

        $acceptance->save();

        for($i = 0; $i < count($items); $i++){

            $acceptance_detail = AcceptanceDetail::create(array(
                    'acceptance_fk' => $acceptance->id,
                    'item_fk' => $items[$i]->item_fk,
                    'unit_fk' => $items[$i]->unit_fk,
                    'quantity' => $items[$i]->quantity,
                    'is_active' => 1
            ));
            
            $acceptance_detail->save();

            $stock_card = StockCard::create(array(
                        'item_fk' => $items[$i]->item_fk,
                        'date' => date("Y-m-d"),
                        'reference' => "Acceptance",
                        'acceptance_fk' => $acceptance->id,
                        'reference_no' => "ACC-" . sprintf("%04d", $acceptance_detail->id),
                        'received_quantity' => $items[$i]->quantity
            ));

            $stock_card->save();               

            $item = Item::find($items[$i]->item_fk);

            $item->item_quantity = ($item->item_quantity + (int)$items[$i]->quantity);
            $item->save();

        }

        return redirect("transaction/acceptance");
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
    							"purchase_order.po_no", "purchase_order.agency_fk", "agency.agency_name")
    				->where("purchase_order.id", $selected_po_no)
                    ->first();

        $po_date = date('F d, Y', strtotime($po_header->invoice_date));
        $po_supplier_fk = $po_header->supplier_fk;
        $po_supplier_name = $po_header->supplier_name;
        $po_agency_fk = $po_header->agency_fk;
        $po_agency_name = $po_header->agency_name;
        $po_no = $po_header->po_no;
                    
    	$po_items = \DB::table("purchase_order_detail")
    				->join("item", "item.id", "=", "purchase_order_detail.item_fk")
    				->join("unit", "unit.id", "=", "purchase_order_detail.unit_fk")
    				->select("purchase_order_detail.stock_no", "purchase_order_detail.item_fk", "item.item_name",
    							"purchase_order_detail.unit_fk", "unit.unit_name", "purchase_order_detail.quantity",
    							"item.item_description")
    				->where("purchase_order_detail.po_id_fk", $selected_po_no)
    				->get();

        session(['acceptance_items' => $po_items]);
        session(['acceptance_po_no' => $selected_po_no]);

    	return view("transaction.transaction-acceptance")
                ->with("po_number", $po_no)
    			->with("po_date", $po_date)
                ->with("po_supplier_fk", $po_supplier_fk)
                ->with("po_supplier_name", $po_supplier_name)
                ->with("po_agency_fk", $po_agency_fk)
                ->with("po_agency_name", $po_agency_name)
    			->with("po_items", $po_items)
    			->with("po_nos", $po_nos)
				->with("departments", $departments)
				->with("users", $users);
    }



}


