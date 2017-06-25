<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use PDF;

use App\PurchaseRequest;
use App\PurchaseRequestDetail;
use App\Issuance;
use App\IssuanceDetail;
use App\Agency;
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
    	$agencies = Agency::all();
    	$departments = Department::all();
    	$offices = Office::all();
    	$users = User::all();
    	$designations = Designation::all();

    	$items = Item::all();
    	$units = Unit::all();

        session(["item-counter" => $i]);  

		return view("transaction.transaction-issuance")
			->with("agencies", $agencies)
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
                'agency_fk' => $request->input('add-agency'),
                'department_fk' => $request->input('add-department'),
                'office_fk' => $request->input("add-office"),
                'reasonability_center_code' => $request->input('add-code'),
                'ris_no' => $request->input('add-ris-no'),
                'ris_date' => date("Y-m-d", strtotime($request->input('add-ris-date'))),
                'sai_no' => $request->input('add-sai-no'),
                'sai_date' =>  date("Y-m-d", strtotime($request->input('add-sai-date'))),
                'purpose' => $request->input('add-purpose'),
                'requested_by_fk' => $request->input('add-requested-by'),
                'requestor_designation_fk' =>  $request->input('add-requestor-designation'),
                'request_date' => date("Y-m-d", strtotime($request->input('add-request-date'))),
                'approver_fk' => $request->input('add-approved-by'),
                'approver_designation_fk' => $request->input('add-approver-designation'),
                'approved_date' =>  date("Y-m-d", strtotime($request->input('add-sai-date'))),
                'issued_by_fk' => $request->input('add-issued-by'),
                'issuer_designation_fk' => $request->input('add-issuer-designation'),
                'issued_date' =>  date("Y-m-d", strtotime($request->input('add-issued-date'))),
                'received_by_fk' => $request->input('add-received-by'),
                'recipient_designation_fk' => $request->input('add-reciepient-designation'),
                'receipt_date' =>  date("Y-m-d", strtotime($request->input('add-receipt-date'))),
                'is_active' => 1
            ));

        $issuance->save();

        for($i = 0; $i < count($item_count); $i++){

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

            $stock_card = StockCard::create(array(
                        'item_fk' => $items[$i],
                        'date' => date("Y-m-d"),
                        'reference' => "Issuance",
                        'issuance_fk' => $issuance->id,
                        'reference_no' => "ISS-" . sprintf("%04d", $issuance_detail->id),
                        'issued_quantity' => $quantities[$i],
                        'office_fk' => $request->input("add-office"),
                        'no_of_days_consume' => $no_of_days_consume[$i]

            ));

            $stock_card->save();      

            $item = Item::find($items[$i]);

            $item->item_quantity = ($item->item_quantity - (int)$quantities[$i]);
            $item->save();

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
            		'unit_id' => $selected_unit->id,
            		'unit_name' => $selected_unit->unit_name,
            		'quantity' => $request->input('quantity'),
            		'remarks' => $request->input('remarks')
            	));
        }
    }

    public function issuance_pdf()
    {
        $items = Item::all();
        $user = "Daniel John Israel Sison Valle Jr.";

        view()->share('items', $items);
        view()->share('user', $user);

        $pdf = PDF::loadView('pdf.issuance-report-pdf');
        return $pdf->download('issuance_pdf.pdf');
    }    




}


