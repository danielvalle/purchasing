<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use PDF;

use App\PurchaseRequest;
use App\PurchaseRequestDetail;
use App\RequestForQuote;
use App\RequestForQuoteDetail;
use App\User;
use App\Designation;
use App\Item;
use App\Category;
use App\Unit;
use App\Supplier;
use App\Http\Controllers\Controller;

class RequestForQuotationController extends Controller
{
    
    public function index()
    {
        $purchase_requests = [];

        $pr_headers = PurchaseRequest::all();
        $categories = Category::all();
        $suppliers = Supplier::all();

        $users = User::all();
        $designations = Designation::all();

        $pr_id = "";
        $category_id = "";

        session(['rfq_pr_no' => null]);

        return view("transaction.transaction-request-for-quotation")
                ->with('categories', $categories)
                ->with('pr_headers', $pr_headers)
                ->with('suppliers', $suppliers)
                ->with('purchase_requests', $purchase_requests)
                ->with('users', $users)
                ->with('designations', $designations)
                ->with('pr_id', $pr_id)
                ->with('category_id', $category_id);
    }

    public function show_rfq()
    {
        $purchase_requests = \DB::table('purchase_request_detail')
                    ->join('item', 'purchase_request_detail.item_fk', '=', 'item.id')
                    ->join('unit', 'purchase_request_detail.unit_of_issue_fk', '=', 'unit.id')
                    ->select('purchase_request_detail.*', 'item.*', 'item.id AS item_id', 'unit.*', 'unit.id AS unit_id')
                    ->where('purchase_request_detail.purchase_request_fk', session()->get('rfq_pr_no'))
                    ->where('purchase_request_detail.category_fk', session()->get('rfq_category'))
                    ->get();

        session(['rfq_pr_count' => count($purchase_requests)]);

        $pr_headers = PurchaseRequest::all();
        $categories = Category::all();
        $suppliers = Supplier::all();

        $users = User::all();
        $designations = Designation::all();

        if($purchase_requests == null) Session::flash('rfq_search_error', 'There are no items for that category in that Purchase Request.');

        return view("transaction.transaction-request-for-quotation")
                ->with('categories', $categories)
                ->with('pr_headers', $pr_headers)
                ->with('suppliers', $suppliers)
                ->with('users', $users)
                ->with('designations', $designations)
                ->with('purchase_requests', $purchase_requests)
                ->with('pr_id', session()->get('rfq_pr_no'))
                ->with('category_id', session()->get('rfq_category'));
    }

    public function get_rfq(Request $request)
    {
        session(['rfq_pr_no' => $request->input('select-pr-no')]);
        session(['rfq_category' => $request->input('select-category')]);

        return redirect('transaction/request-for-quotation-show');
    }

    public function store(Request $request) 
    {
        $suppliers = $request->input("add-supplier");
        $suppliers_for_printing = $request->input("add-print-supplier");
        $item_start = $request->input('item_id' . "0");

        for($i = count($suppliers); $i < 5; $i++){
            $suppliers[$i] = null;
        }

        if($item_start == null)
        {
            \Session::flash('rfq_add_fail','You have not selected a Purchase Request. Request For Quotation is not sent.');
            
            return redirect('transaction/request-for-quotation');
        }
        else
        {
            $request_for_quotation = RequestForQuote::create(array(
                    'date' => date("Y-m-d", strtotime($request->input('transaction_date'))),
                    'supplier1_fk' => $suppliers[0],
                    'supplier2_fk' => $suppliers[1],
                    'supplier3_fk' => $suppliers[2],
                    'supplier4_fk' => $suppliers[3],
                    'supplier5_fk' => $suppliers[4],
                    'category_fk' => $request->input("category_id"),
                    'vat_nonvat_tin' => $request->input("add-tin"),
                    'place_of_delivery' => $request->input("add-place-delivery"),
                    'within_no_of_days' => $request->input("add-days"),
                    'requestor_fk' => $request->input("add-requestor") == "" ? null : $request->input("add-requestor"),
                    'canvasser_fk' => $request->input("add-canvasser"),
                    'pr_fk' => $request->input("pr_id"),
                    'is_active' => 1
            ));

            $request_for_quotation->save();

            $request_for_quotation = RequestForQuote::find($request_for_quotation->id);

            $request_for_quotation->rfq_number = date("Y-m", strtotime($request_for_quotation->date)) . "-" . sprintf("%04d", $request_for_quotation->id);
            $request_for_quotation->save();

            session(["pdf_rfq_id" => $request_for_quotation->id]);
            session(["pdf_supp_id" => $suppliers_for_printing]);

            for($i = 0; $i < session()->get('rfq_pr_count'); $i++){

                $request_for_quotation_detail = RequestForQuoteDetail::create(array(
                        'request_for_quote_fk' => $request_for_quotation->id,
                        'quantity' => $request->input('quantity' . $i),
                        'item_fk' => $request->input('item_id' . $i),
                        'unit_fk' => $request->input('unit_id' . $i),
                        'total' => $request->input('total' . $i),
                        'is_active' => 1
                ));        

                $request_for_quotation_detail->save();

            }

            \Session::flash('rfq_add_success','Request For Quotation is successfully sent. Reference No. is RFQ No. ' . $request_for_quotation->rfq_number);

            if($suppliers_for_printing != null) \Session::flash('rfq_new_check','yes');

            return redirect("transaction/request-for-quotation");   
        }

    }

    public function rfq_pdf()
    {   
        $supp_ids = session()->get("pdf_supp_id");

        for($i = 0; $i < count($supp_ids); $i++)
        {
            $rfq_suppliers[$i] = \DB::table("supplier")
                        ->select("supplier_name")
                        ->where("id", $supp_ids[$i])
                        ->first();
        }

        $rfq_header = \DB::table("request_for_quote as rfq")
                        ->leftJoin("purchase_request as pr", "pr.id", "=", "rfq.pr_fk")
                        ->select("rfq.place_of_delivery", "rfq.within_no_of_days", "rfq.vat_nonvat_tin", "rfq.date", "rfq.rfq_number", 
                                 "pr.pr_number", "pr.purpose")
                        ->where("rfq.id", session()->get("pdf_rfq_id"))
                        ->first();

        $requestor = \DB::table("request_for_quote")
                ->leftJoin("user", "requestor_fk", "=", "user.id")
                ->select("user.first_name", "user.middle_name", "user.last_name")
                ->where("request_for_quote.id", session()->get("pdf_rfq_id"))
                ->first();

        $canvasser = \DB::table("request_for_quote")
                ->leftJoin("user", "canvasser_fk", "=", "user.id")
                ->select("user.first_name", "user.middle_name", "user.last_name")
                ->where("request_for_quote.id", session()->get("pdf_rfq_id"))
                ->first();

        $rfq_items = \DB::table("request_for_quote_detail as r")
                ->leftJoin("item", "item.id", "=", "r.item_fk")
                ->leftJoin("unit", "unit.id", "=", "r.unit_fk") 
                ->select("item_name", "unit_name", "r.quantity")
                ->where("r.request_for_quote_fk", session()->get("pdf_rfq_id"))
                ->get();

        view()->share('supp_ids', $supp_ids);
        view()->share('supplier', $rfq_suppliers);
        view()->share('header', $rfq_header);
        view()->share('requestor', $requestor);
        view()->share('canvasser', $canvasser);
        view()->share('items', $rfq_items);
        
        $pdf = PDF::loadView('pdf.request-for-quotation-pdf');
        return $pdf->download('RFQ' . $rfq_header->rfq_number . '.pdf');
    }    

}


