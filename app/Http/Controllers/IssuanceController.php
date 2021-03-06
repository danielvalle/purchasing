<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use PDF;

use App\PurchaseRequest;
use App\PurchaseRequestDetail;
use App\Issuance;
use App\IssuanceDetail;
use App\Entity;
use App\Department;
use App\Office;
use App\Designation;
use App\User;
use App\Item;
use App\Category;
use App\Unit;
use App\Supplier;
use App\StockCard;
use App\Http\Controllers\Controller;

class IssuanceController extends Controller
{
	
	public function index()
    {
        $i = 0;
    	$entities = Entity::all();
    	$departments = Department::all();
    	$offices = Office::all();
    	$users = User::all();
    	$designations = Designation::all();

    	$items = Item::all();
    	$units = Unit::all();

        session(["item-counter" => $i]);  

		return view("transaction.transaction-issuance")
			->with("entities", $entities)
			->with("departments", $departments)
			->with("offices", $offices)
			->with("users", $users)
			->with("designations", $designations)
			->with("items", $items)
			->with("units", $units);
    }

    public function store(Request $request) 
    {
        $item_count = session()->get("item-counter");
        
        if($item_count == 0)
        {
            \Session::flash('issue_add_fail','You have not selected any item(s). Issuance is not sent.');
        }
        else
        {
            for($i = 0; $i < $item_count; $i++)
            {
                $quantities[$i] = $request->input("quantity" . $i);
                $stock_nos[$i] = $request->input("hdn-stock-no" . $i);
                $items[$i] = $request->input("hdn-item" . $i);
                $units[$i] = $request->input("hdn-unit" . $i);
                $no_of_days_consume[$i] = $request->input("no-days-consume" . $i);
                $remarks[$i] = $request->input("hdn-remarks" . $i);
            }
            
            $issuance = Issuance::create(array(
                    'entity_fk' => $request->input('add-entity'),
                    'department_fk' => $request->input('add-department'),
                    'office_fk' => $request->input("add-office"),
                    'reasonability_center_code' => $request->input('add-code'),
                    'ris_no' => $request->input('add-ris-no'),
                    'ris_date' => $request->input('add-ris-date') != '' ? date("Y-m-d", strtotime($request->input('add-ris-date'))) : null,
                    'sai_no' => $request->input('add-sai-no'),
                    'sai_date' =>  $request->input('add-sai-date') != '' ? date("Y-m-d", strtotime($request->input('add-sai-date'))) : null,
                    'purpose' => $request->input('add-purpose'),
                    'requested_by_fk' => $request->input('add-requested-by'),
                    'requestor_designation_fk' =>  $request->input('add-requestor-designation'),
                    'request_date' => $request->input('add-request-date') != '' ? date("Y-m-d", strtotime($request->input('add-request-date'))) : null,
                    'approver_fk' => $request->input('add-approved-by'),
                    'approver_designation_fk' => $request->input('add-approver-designation'),
                    'approved_date' =>  $request->input('add-approved-date') != '' ? date("Y-m-d", strtotime($request->input('add-approved-date'))) : null,
                    'issued_by_fk' => $request->input('add-issued-by'),
                    'issuer_designation_fk' => $request->input('add-issuer-designation'),
                    'issued_date' =>  $request->input('add-issued-date') != '' ? date("Y-m-d", strtotime($request->input('add-issued-date'))) : null,
                    'received_by_fk' => $request->input('add-received-by'),
                    'recipient_designation_fk' => $request->input('add-reciepient-designation'),
                    'receipt_date' =>  $request->input('add-receipt-date') != '' ? date("Y-m-d", strtotime($request->input('add-receipt-date'))) : null,
                    'is_active' => 1
                ));

            $issuance->save();

            $issuance = Issuance::find($issuance->id);

            $issuance->issuance_number = date("Y-m") . "-" . sprintf("%04d", $issuance->id);
            $issuance->save();

            session(["pdf_issue_id" => $issuance->id]);

            for($i = 0; $i < count($item_count); $i++){

                $item = Item::find($items[$i]);

                $item->stock_quantity = ($item->stock_quantity - (int)$quantities[$i]);
                $item->save();

                $new_qty = $item->stock_quantity;
    
                $issuance_detail = IssuanceDetail::create(array(
                        'issuance_fk' => $issuance->id,
                        'stock_no' => $stock_nos[$i],
                        'item_fk' => $items[$i],
                        'unit_fk' => $units[$i],
                        'quantity' => $quantities[$i],
                        'no_of_days_consume' => $no_of_days_consume[$i],
                        'remarks' => $remarks[$i],
                        'is_active' => 1
                ));
                
                $issuance_detail->save();

                $quantity_unit = \DB::table('unit')
                                    ->select('unit_name')
                                    ->where('id', $units[$i])
                                    ->first();

                $stock_card = StockCard::create(array(
                        'item_fk' => $items[$i],
                        'date' => date("Y-m-d"),
                        'reference' => "Issuance",
                        'issuance_fk' => $issuance->id,
                        'reference_no' => "RIS-" . date("Y-m") . "-" . sprintf("%04d", $issuance_detail->id),
                        'issued_quantity' => $quantities[$i],
                        'issued_quantity_unit' => $quantity_unit->unit_name,
                        'office_fk' => $request->input("add-office"),
                        'no_of_days_consume' => $no_of_days_consume[$i],
                        'balanced_quantity' => $new_qty, 
                        'balanced_quantity_unit' => $quantity_unit->unit_name
                ));

                $stock_card->save();                

            }

            \Session::flash('issue_add_success','Issuance is successfully sent. Reference No. is ISS No. ' . $issuance->issuance_number);

            \Session::flash('issue_new_check','yes');
        }

        return redirect("transaction/issuance");
    }

    public function add_item(Request $request)
    {   

    	$selected_item = \DB::table("item")
    				->select("*")
    				->where("id", $request->input("item_id"))
    				->first();

    	$selected_unit = \DB::table("unit")
    				->select("*")
    				->where("id", $request->input("unit_id"))
    				->first();

        $temp_counter = (int)session()->get("item-counter");
        $temp_counter += 1;
        session(["item-counter" => $temp_counter]);  

        if($request->ajax()){

            return response()->json(array(
            		'stock_no' => $selected_item->stock_no,
            		'item_id' => $selected_item->id,
            		'item_name' => $selected_item->item_name,
            		'item_description' => $selected_item->item_description,
                    'item_quantity' => (int)$selected_item->stock_quantity,
            		'unit_id' => $selected_unit->id,
            		'unit_name' => $selected_unit->unit_name,
            		'quantity' => $request->input('quantity'),
            		'remarks' => $request->input('remarks')
            	));
        }
    }

    public function issuance_pdf()
    {
        $issuance_header = \DB::table("issuance as i")
                    ->leftJoin("department as d", "i.department_fk", "=", "d.id")
                    ->leftJoin("office as o", "i.office_fk", "=", "o.id")
                    ->select("d.department_name", "o.office_name", "i.reasonability_center_code",
                             "i.ris_no", "i.ris_date", "i.sai_no", "i.sai_date", "i.purpose",
                             "i.issuance_number")
                    ->where("i.id", session()->get("pdf_issue_id"))
                    ->first();

        $items = \DB::table("issuance_detail as id")
                    ->leftJoin("item as i", "id.item_fk", "=", "i.id")
                    ->leftJoin("unit as u", "id.unit_fk", "=", "u.id")
                    ->select("i.item_name", "u.unit_name", "id.stock_no",
                             "id.quantity", "id.no_of_days_consume", "id.remarks")
                    ->where("id.issuance_fk", session()->get("pdf_issue_id"))
                    ->get();

        $requested_by = \DB::table("issuance AS i")
                ->leftJoin("user", "i.requested_by_fk", "=", "user.id")
                ->leftJoin("designation as d", "i.requestor_designation_fk", "=", "d.id")
                ->select("user.first_name", "user.middle_name", "user.last_name", 
                         "d.designation_name", "i.request_date")
                ->where("i.id", session()->get("pdf_issue_id"))
                ->first();

        $approved_by = \DB::table("issuance AS i")
                ->leftJoin("user", "i.approver_fk", "=", "user.id")
                ->leftJoin("designation as d", "i.approver_designation_fk", "=", "d.id")
                ->select("user.first_name", "user.middle_name", "user.last_name", 
                         "d.designation_name", "i.approved_date")
                ->where("i.id", session()->get("pdf_issue_id"))
                ->first();

        $issued_by = \DB::table("issuance AS i")
                ->leftJoin("user", "i.issued_by_fk", "=", "user.id")
                ->leftJoin("designation as d", "i.issuer_designation_fk", "=", "d.id")
                ->select("user.first_name", "user.middle_name", "user.last_name", 
                         "d.designation_name", "i.issued_date")
                ->where("i.id", session()->get("pdf_issue_id"))
                ->first();

        $received_by = \DB::table("issuance AS i")
                ->leftJoin("user", "i.received_by_fk", "=", "user.id")
                ->leftJoin("designation as d", "i.recipient_designation_fk", "=", "d.id")
                ->select("user.first_name", "user.middle_name", "user.last_name", 
                         "d.designation_name", "i.receipt_date")
                ->where("i.id", session()->get("pdf_issue_id"))
                ->first();
        
        view()->share('header', $issuance_header);
        view()->share('items', $items);
        view()->share('requested_by', $requested_by);
        view()->share('approved_by', $approved_by);
        view()->share('issued_by', $issued_by);
        view()->share('received_by', $received_by);

        $pdf = PDF::loadView('pdf.issuance-report-pdf');
        return $pdf->download('RIS' . $issuance_header->issuance_number . '.pdf');
    }    




}


