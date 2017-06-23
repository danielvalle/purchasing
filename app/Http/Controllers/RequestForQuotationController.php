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

        $pr_id = "";
        $category_id = "";

        return view("transaction.transaction-request-for-quotation")
                ->with('categories', $categories)
                ->with('pr_headers', $pr_headers)
                ->with('suppliers', $suppliers)
                ->with('purchase_requests', $purchase_requests)
                ->with('users', $users)
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

        return view("transaction.transaction-request-for-quotation")
                ->with('categories', $categories)
                ->with('pr_headers', $pr_headers)
                ->with('suppliers', $suppliers)
                ->with('users', $users)
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

        for($i = count($suppliers); $i < 5; $i++){
            $suppliers[$i] = null;
        }

        $request_for_quotation = RequestForQuote::create(array(
                'date' => date("Y-m-d", strtotime($request->input('transaction_date'))),
                'supplier1_fk' => $suppliers[0],
                'supplier2_fk' => $suppliers[1],
                'supplier3_fk' => $suppliers[2],
                'supplier4_fk' => $suppliers[3],
                'supplier5_fk' => $suppliers[4],
                'category_fk' => $request->input("category_id"),
                'vat_notvat_tin' => $request->input("add-tin"),
                'place_of_delivery' => $request->input("add-place-delivery"),
                'within_no_of_days' => $request->input("add-days"),
                'requestor_fk' => $request->input("add-requestor"),
                'canvasser_fk' => $request->input("add-canvasser"),
                'pr_fk' => $request->input("pr_id"),
                'is_active' => 1
        ));

        $request_for_quotation->save();

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

        return redirect("transaction/request-for-quotation");

    }

    public function rfq_pdf()
    {
        $items = Item::all();
        $user = "Daniel John Israel Sison Valle Jr.";

        view()->share('items', $items);
        view()->share('user', $user);

        $pdf = PDF::loadView('pdf.request-for-quotation-pdf');
        return $pdf->download('rfq_pdf.pdf');
    }    

}


