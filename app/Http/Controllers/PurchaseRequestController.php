<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use PDF;

use App\PurchaseRequest;
use App\PurchaseRequestDetail;
use App\Entity;
use App\Department;
use App\Office;
use App\User;
use App\Designation;
use App\Item;
use App\Category;
use App\Unit;
use App\Supplier;
use App\Http\Controllers\Controller;

class PurchaseRequestController extends Controller
{
	
	public function index()
    {
        $entities = Entity::all();
        $departments = Department::all();
        $offices = Office::all();
        $users = User::all();
        $designations = Designation::all();

        $items = Item::all();
        $categories = Category::all();
        $units = Unit::all();
        $suppliers = Supplier::all();

        $pr_items = [];
        $pr_categories = [];
        $pr_quantities = [];
        $pr_units = [];
        $pr_suppliers = [];

        $temp_suppliers = [];
        $temp_pr_items = [];
 
        session(['pr_items' => $pr_items]);
        session(['pr_quantities' => $pr_quantities]);
        session(['pr_categories' => $pr_categories]);
        session(['pr_units' => $pr_units]);
        session(['pr_suppliers' => $pr_suppliers]);

        session(['temp_suppliers' => $temp_suppliers]);
        session(['temp_pr_items' => $temp_pr_items]);

		return view("transaction.transaction-purchase-request")
            ->with("users", $users)
            ->with("designations", $designations)
            ->with("items", $items)
            ->with("entities", $entities)
            ->with("departments", $departments)
            ->with("offices", $offices)
            ->with("categories", $categories)
            ->with("units", $units)
            ->with("suppliers", $suppliers)
            ->with("pr_items", $pr_items)
            ->with("pr_categories", $pr_categories)
            ->with("pr_quantities", $pr_quantities)
            ->with("pr_units", $pr_units);
    }

    public function show_pr(Request $request)
    {
        $entities = Entity::all();
        $departments = Department::all();
        $offices = Office::all();
        $users = User::all();
        $designations = Designation::all();

        $items = \DB::table('item')->select('*')->get();
        $categories = Category::all();
        $units = Unit::all();
        $suppliers = Supplier::all();

        $pr_items = session()->get('temp_pr_items');
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

        session(['pr_items' => $pr_items]);
        
        foreach($items as $key => $item) {
            if(in_array($item, $pr_items)) {
                unset($items[$key]);
            }
        }

        return view("transaction.transaction-purchase-request")
            ->with("entities", $entities)
            ->with("departments", $departments)
            ->with("offices", $offices)
            ->with("users", $users)
            ->with("designations", $designations)
            ->with("items", $items)
            ->with("categories", $categories)
            ->with("units", $units)
            ->with("suppliers", $suppliers)
            ->with("pr_items", $pr_items)
            ->with("pr_categories", $pr_categories)
            ->with("pr_quantities", $pr_quantities)
            ->with("pr_units", $pr_units);
    }

    public function add_item(Request $request)
    {   

        $request->session()->push('temp_pr_items', $request->input('add-item'));

        $request->session()->push('pr_categories', $request->input('add-category'));

        $request->session()->push('pr_quantities', $request->input('add-quantity'));

        $request->session()->push('pr_units', $request->input('add-unit'));

        $request->session()->push('pr_suppliers', session()->get('temp_suppliers'));
        
        return redirect('transaction/purchase-request-show');
    }

    public function edit_item(Request $request)
    {
        $edit_index = ((int)$request->input('edit-item-id'));

        $pr_items = session()->get('temp_pr_items');
        $pr_quantities = session()->get('pr_quantities');
        $pr_units = session()->get('pr_units');
        $pr_categories = session()->get('pr_categories');
 
        $pr_items[$edit_index] = $request->input('edit-item');
        $pr_quantities[$edit_index] = $request->input('edit-quantity');
        $pr_units[$edit_index] = $request->input('edit-unit');
        $pr_categories[$edit_index] = $request->input('edit-category');

        session(['temp_pr_items' => $pr_items]);
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
        $pr_items = session()->get('pr_items');

        if($pr_items == null)
        {
            \Session::flash('pr_add_fail','You have not selected any items. Purchase Request is not sent.');

            return redirect("transaction/purchase-request-show");
        }
        else
        {
            $purchase_request = PurchaseRequest::create(array(
                    'entity_fk' => $request->input('add-entity'),
                    'fund_cluster' => $request->input('add-fund-cluster'),
                    'office_fk' => $request->input('add-office'),
                    'responsibility_center_code' => $request->input('add-responsibility-center-code'),
                    'department_fk' => $request->input('add-department'),
                    'requested_by_fk' => $request->input('add-requested-by'),
                    'requestor_designation_fk' => $request->input('add-requestor-designation'),
                    'approved_by_fk' => $request->input('add-approved-by'),
                    'approver_designation_fk' => $request->input('add-approver-designation'),
                    'purpose' => $request->input('add-purpose'),
                    'pr_date' =>  date("Y-m-d", strtotime($request->input('transaction_date'))),
                    'is_active' => 1
            ));

            $purchase_request->save();

            $purchase_request = PurchaseRequest::find($purchase_request->id);

            $purchase_request->pr_number = date("Y-m", strtotime($purchase_request->pr_date)) . "-" . sprintf("%04d", $purchase_request->id);
            $purchase_request->save();
            
            session(["pdf_pr_id" => $purchase_request->id]);

            for($i = 0; $i < count($pr_items); $i++){

                $purchase_request_detail = PurchaseRequestDetail::create(array(
                        'purchase_request_fk' => $purchase_request->id,
                        'quantity' => session()->get('pr_quantities')[$i],
                        'unit_of_issue_fk' => session()->get('pr_units')[$i],
                        'item_fk' => $pr_items[$i]->id,
                        'category_fk' => session()->get('pr_categories')[$i],
                        'stock_no' => $pr_items[$i]->stock_no,
                        'is_active' => 1
                ));
                
                $purchase_request_detail->save();

            }
            
            \Session::flash('pr_add_success','Purchase Request is successfully sent. Reference No. is PR No. ' . $purchase_request->pr_number);

            \Session::flash('pr_new_check','yes');

            return redirect("transaction/purchase-request");
        }

    }

    public function update(Request $request)
    {


    }

    public function delete(Request $request)
    {
     
        $del_index = ((int)$request->input('del-item-id'));

        $temp_pr_items = session()->get('temp_pr_items');
        $pr_quantities = session()->get('pr_quantities');
        $pr_units = session()->get('pr_units');
        $pr_suppliers = session()->get('pr_suppliers');
        
        unset($temp_pr_items[$del_index]);
        $temp_pr_items = array_slice($temp_pr_items, 0);

        unset($pr_quantities[$del_index]);
        $pr_quantities = array_slice($pr_quantities, 0);

        unset($pr_units[$del_index]);
        $pr_units = array_slice($pr_units, 0);

        unset($pr_suppliers[$del_index]);
        $pr_suppliers = array_slice($pr_suppliers, 0);

        session()->forget('temp_pr_items');
        session(['temp_pr_items' => $temp_pr_items]);

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
        $items = Item::all();
        
        $pr_header = \DB::table("purchase_request AS pr")
                ->leftJoin("department AS dept", "pr.department_fk", "=", "dept.id")
                ->leftJoin("office AS of", "pr.office_fk", "=", "of.id")
                ->leftJoin("entity AS e", "pr.entity_fk", "=", "e.id")
                ->select("dept.department_name", "of.office_name", "pr.pr_number",
                         "e.entity_name", "pr.pr_date", "pr.fund_cluster", "pr.purpose",
                         "pr.responsibility_center_code")
                ->where("pr.id", session()->get("pdf_pr_id"))
                ->first();

        $pr_requested_by = \DB::table("purchase_request AS pr")
                ->leftJoin("user", "pr.requested_by_fk", "=", "user.id")
                ->leftJoin("designation AS des", "pr.requestor_designation_fk", "=", "des.id")
                ->select("user.first_name", "user.middle_name", "user.last_name",
                         "des.designation_name")
                ->where("pr.id", session()->get("pdf_pr_id"))
                ->first();

        $pr_approved_by = \DB::table("purchase_request AS pr")
                ->leftJoin("user", "pr.approved_by_fk", "=", "user.id")
                ->leftJoin("designation AS des", "pr.approver_designation_fk", "=", "des.id")
                ->select("user.first_name", "user.middle_name", "user.last_name",
                         "des.designation_name")
                ->where("pr.id", session()->get("pdf_pr_id"))
                ->first();

        $pr_items = \DB::table("purchase_request_detail AS prd")
                ->leftJoin("item", "prd.item_fk", "=", "item.id")
                ->leftJoin("unit", "prd.unit_of_issue_fk", "=", "unit.id")
                ->select("item.item_name", "unit.unit_name", "prd.stock_no", "prd.quantity")
                ->where("prd.purchase_request_fk", session()->get("pdf_pr_id"))
                ->get();

        view()->share('pr_header', $pr_header);
        view()->share('pr_requested_by', $pr_requested_by);
        view()->share('pr_approved_by', $pr_approved_by);
        view()->share('items', $pr_items);
        
        $pdf = PDF::loadView('pdf.purchase-request-pdf');
        return $pdf->download('PR' . $pr_header->pr_number . '.pdf');
    }

}


