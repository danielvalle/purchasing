<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use PDF;

use App\PurchaseRequest;
use App\PurchaseRequestDetail;
use App\Agency;
use App\Department;
use App\Section;
use App\User;
use App\Item;
use App\Category;
use App\Unit;
use App\Supplier;
use App\Http\Controllers\Controller;

class PurchaseRequestController extends Controller
{
	
	public function index()
    {
        $agencies = Agency::all();
        $departments = Department::all();
        $sections = Section::all();
        $users = User::all();

        $items = Item::all();
        $categories = Category::all();
        $units = Unit::all();
        $suppliers = Supplier::all();

        $pr_stock_nos = [];
        $pr_items = [];
        $pr_categories = [];
        $pr_quantities = [];
        $pr_units = [];
        $pr_suppliers = [];

        $temp_suppliers = [];

        session(['pr_stock_nos' => $pr_stock_nos]);
        session(['pr_items' => $pr_items]);
        session(['pr_quantities' => $pr_quantities]);
        session(['pr_categories' => $pr_categories]);
        session(['pr_units' => $pr_units]);
        session(['pr_suppliers' => $pr_suppliers]);

        session(['temp_suppliers' => $temp_suppliers]);

		return view("transaction.transaction-purchase-request")
            ->with("users", $users)
            ->with("items", $items)
            ->with("agencies", $agencies)
            ->with("departments", $departments)
            ->with("sections", $sections)
            ->with("categories", $categories)
            ->with("units", $units)
            ->with("suppliers", $suppliers)
            ->with("pr_stock_nos", $pr_stock_nos)
            ->with("pr_items", $pr_items)
            ->with("pr_categories", $pr_categories)
            ->with("pr_quantities", $pr_quantities)
            ->with("pr_units", $pr_units);
    }

    public function show_pr()
    {
        $agencies = Agency::all();
        $departments = Department::all();
        $sections = Section::all();
        $users = User::all();

        $items = Item::all();
        $categories = Category::all();
        $units = Unit::all();
        $suppliers = Supplier::all();

        $pr_stock_nos = session()->get('pr_stock_nos');
        $pr_items = session()->get('pr_items');
        $pr_categories = session()->get('pr_categories');
        $pr_quantities = session()->get('pr_quantities');
        $pr_units = session()->get('pr_units');

        $temp_suppliers = [];

        session(['temp_suppliers' => $temp_suppliers]);

        $temp_items = [];
        $temp_units = [];
        $temp_categories = [];

        $sql_items = \DB::table('item')
                ->select('*')
                ->whereIn('id', $pr_items)
                ->get();

        $sql_units = \DB::table('unit')
                ->select('*')
                ->whereIn('id', $pr_units)
                ->get();

        $sql_categories = \DB::table('category')
                ->select('*')
                ->whereIn('id', $pr_categories)
                ->get();

        //dd($pr_units);

        for($i = 0; $i < count($pr_items); $i++){
            for($j = 0; $j < count($sql_items); $j++){
                if($pr_items[$i] == $sql_items[$j]->id){
                    $temp_items[$i] = $sql_items[$j];
                }
            }
        }

        for($i = 0; $i < count($pr_units); $i++){
            for($j = 0; $j < count($sql_units); $j++){
                if($pr_units[$i] == $sql_units[$j]->id){
                    $temp_units[$i] = $sql_units[$j];
                }
            }
        }    

        for($i = 0; $i < count($pr_categories); $i++){
            for($j = 0; $j < count($sql_categories); $j++){
                if($pr_categories[$i] == $sql_categories[$j]->id){
                    $temp_categories[$i] = $sql_categories[$j];
                }
            }
        }      

        $pr_items = $temp_items;
        $pr_units = $temp_units;
        $pr_categories = $temp_categories;

        return view("transaction.transaction-purchase-request")
            ->with("agencies", $agencies)
            ->with("departments", $departments)
            ->with("sections", $sections)
            ->with("users", $users)
            ->with("items", $items)
            ->with("categories", $categories)
            ->with("units", $units)
            ->with("suppliers", $suppliers)
            ->with("pr_stock_nos", $pr_stock_nos)
            ->with("pr_items", $pr_items)
            ->with("pr_categories", $pr_categories)
            ->with("pr_quantities", $pr_quantities)
            ->with("pr_units", $pr_units);
    }

    public function add_item(Request $request)
    {        
        $request->session()->push('pr_stock_nos', $request->input('add-stock-no'));

        $request->session()->push('pr_items', $request->input('add-item'));

        $request->session()->push('pr_categories', $request->input('add-category'));

        $request->session()->push('pr_quantities', $request->input('add-quantity'));

        $request->session()->push('pr_units', $request->input('add-unit'));

        $request->session()->push('pr_suppliers', session()->get('temp_suppliers'));
        
        return redirect('transaction/purchase-request-show');
    }

    public function edit_item(Request $request)
    {
        $edit_index = ((int)$request->input('edit-item-id'));

        $pr_stock_nos = session()->get('pr_stock_nos');
        $pr_items = session()->get('pr_items');
        $pr_quantities = session()->get('pr_quantities');
        $pr_units = session()->get('pr_units');
        $pr_categories = session()->get('pr_categories');
 
        $pr_stock_nos[$edit_index] = $request->input('edit-stock-no');
        $pr_items[$edit_index] = $request->input('edit-item');
        $pr_quantities[$edit_index] = $request->input('edit-quantity');
        $pr_units[$edit_index] = $request->input('edit-unit');
        $pr_categories[$edit_index] = $request->input('edit-category');

        session(['pr_stock_nos' => $pr_stock_nos]);
        session(['pr_items' => $pr_items]);
        session(['pr_quantities' => $pr_quantities]);
        session(['pr_categories' => $pr_categories]);
        session(['pr_units' => $pr_units]);

        return redirect('transaction/purchase-request-show');

    }

    public function add_supplier(Request $request)
    {

        $request->session()->push('temp_suppliers', $request->input('id'));

        if($request->ajax()){

            return $request->all();
        }
        
    }

    public function store(Request $request) 
    {
        $purchase_request = PurchaseRequest::create(array(
                'agency_fk' => $request->input('add-agency'),
                'department_fk' => $request->input('add-department'),
                'section_fk' => $request->input('add-section'),
                'pr_date' =>  date("Y-m-d", strtotime($request->input('transaction_date'))),
                'sai_no' => $request->input('add-sai-no'),
                'sai_date' =>  date("Y-m-d", strtotime($request->input('add-sai-date'))),
                'purpose' => $request->input('add-purpose'),
                'requested_by_fk' => $request->input('add-requested-by'),
                'approved_by_fk' => $request->input('add-approved-by'),
                'is_active' => 1
        ));

        $purchase_request->save();

        $purchase_request = PurchaseRequest::find($purchase_request->id);

        $purchase_request->pr_number = date("Y-m", strtotime($purchase_request->pr_date)) . "-" . sprintf("%04d", $purchase_request->id);
        $purchase_request->save();
        

        for($i = 0; $i < count(session()->get('pr_items')); $i++){

            $purchase_request_detail = PurchaseRequestDetail::create(array(
                    'purchase_request_fk' => $purchase_request->id,
                    'quantity' => session()->get('pr_quantities')[$i],
                    'unit_of_issue_fk' => session()->get('pr_units')[$i],
                    'item_fk' => session()->get('pr_items')[$i],
                    'category_fk' => session()->get('pr_categories')[$i],
                    'stock_no' => session()->get('pr_stock_nos')[$i],
                    'total_cost' => 0

            ));
            
            $purchase_request_detail->save();

        }
        
        return redirect("transaction/request-for-quotation");

    }

    public function update(Request $request)
    {


    }

    public function delete(Request $request)
    {
        $del_index = ((int)$request->input('del-item-id'));

        $pr_stock_nos = session()->get('pr_stock_nos');
        $pr_items = session()->get('pr_items');
        $pr_quantities = session()->get('pr_quantities');
        $pr_units = session()->get('pr_units');
        $pr_suppliers = session()->get('pr_suppliers');

        unset($pr_stock_nos[$del_index]);
        $pr_stock_nos = array_slice($pr_stock_nos, 0);
        
        unset($pr_items[$del_index]);
        $pr_items = array_slice($pr_items, 0);

        unset($pr_quantities[$del_index]);
        $pr_quantities = array_slice($pr_quantities, 0);

        unset($pr_units[$del_index]);
        $pr_units = array_slice($pr_units, 0);

        unset($pr_suppliers[$del_index]);
        $pr_suppliers = array_slice($pr_suppliers, 0);

        session()->forget('pr_stock_nos');
        session(['pr_stock_nos' => $pr_stock_nos]);

        session()->forget('pr_items');
        session(['pr_items' => $pr_items]);

        session()->forget('pr_quantities');
        session(['pr_quantities' => $pr_quantities]);

        session()->forget('pr_units');
        session(['pr_units' => $pr_units]);

        session()->forget('pr_suppliers');
        session(['pr_suppliers' => $pr_suppliers]);

        return redirect('transaction/purchase-request-show');
    }
	
    public function new_category(Request $request)
    {
        $category = Category::create(array(
                'category_name' =>trim($request->input('new-category')),
                'is_active' => 1
            ));

        $added = $category->save();

        if($request->ajax()){

            return response()->json(array(
                    'id' => $category->id,
                    'name' => $request->input('new-category')
                ));
        }

    }

    public function pr_pdf()
    {
        $pdf = PDF::loadView('pdf.purchase-request-pdf');
        return $pdf->download('pr_pdf.pdf');

        return redirect("transaction/request-for-quotation");
    }

}


