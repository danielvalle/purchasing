<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

use App\DisbursementVoucher;
use App\User;
use App\Item;
use App\Http\Controllers\Controller;

class DisbursementVoucherController extends Controller
{
	
	public function index()
    {
        $users = User::all();

		return view("transaction.transaction-disbursement-voucher")->with("users", $users);
    }

    public function store(Request $request)
    {        
        $disbursement_voucher = DisbursementVoucher::create(array(
                'mode_of_payment' => $request->input('add-mode-of-payment'),
                'payee_fk' => $request->input('add-payee'),
                'employee_no' => $request->input('add-tin'),
                'or_bur_no' => $request->input('add-or-bur-no'),
                'address' => $request->input('add-address'),
                'project' => $request->input('add-office'),
                'code' => $request->input('add-code'),
                'explanation' => $request->input('add-explanation'),
                'amount' => $request->input('add-amount'),
                'certified' => $request->input('add-certified'),
                'certifier_name_fk' => $request->input('add-certifier'),
                'date' => date("Y-m-d", strtotime($request->input('add-certified-date'))),
                'approved_for_payment' => $request->input('add-approved-for-payment'),
                'approver_fk' => $request->input('add-approver'),
                'approve_date' => date("Y-m-d", strtotime($request->input('add-approved-date'))),
                'ada_no' => $request->input('add-check-ada'),
                'payment_check_date' => date("Y-m-d", strtotime($request->input('add-check-date'))),
                'bank_name' => $request->input('add-bank'),
                'jev_no' => $request->input('add-jev-no'),
                'check_printed_name_fk' => $request->input('add-printed-name'),
                'check_date' => date("Y-m-d", strtotime($request->input('add-printed-name-date'))),
                'other_docs' => $request->input('add-documents'),
                'is_active' => 1
            ));
    
        $disbursement_voucher->save();

        $disbursement_voucher = DisbursementVoucher::find($disbursement_voucher->id);

        $disbursement_voucher->dv_number = date("Y-m") . "-" . sprintf("%04d", $disbursement_voucher->id);
        $disbursement_voucher->save();

        session(["pdf_dv_id" => $disbursement_voucher->id]);

        \Session::flash('dv_add_success','Disbursement Voucher is successfully sent. Reference No. is DV No. ' . $disbursement_voucher->dv_number);

        \Session::flash('dv_new_check','yes');

        return redirect("transaction/disbursement-voucher");

    }

    public function update(Request $request)
    {

    }

    public function disbursement_voucher_pdf()
    {
        $dv_header = \DB::table("disbursement_voucher")
                ->select("mode_of_payment", "employee_no", "or_bur_no", "address", "project", "code", 
                         "explanation", "amount", "certified", "date", "approved_for_payment",
                         "approve_date", "ada_no", "payment_check_date", "bank_name", "jev_no",
                         "check_date", "other_docs", "dv_number")
                ->where("id", session()->get("pdf_dv_id"))
                ->first();

        $payee = \DB::table("disbursement_voucher as dv")
                ->leftJoin("user", "dv.payee_fk", "=", "user.id")
                ->select("user.first_name", "user.middle_name", "user.last_name")
                ->where("dv.id", session()->get("pdf_dv_id"))
                ->first();

        $certifier = \DB::table("disbursement_voucher as dv")
                ->leftJoin("user", "dv.certifier_name_fk", "=", "user.id")
                ->select("user.first_name", "user.middle_name", "user.last_name")
                ->where("dv.id", session()->get("pdf_dv_id"))
                ->first();

        $approver = \DB::table("disbursement_voucher as dv")
                ->leftJoin("user", "dv.approver_fk", "=", "user.id")
                ->select("user.first_name", "user.middle_name", "user.last_name")
                ->where("dv.id", session()->get("pdf_dv_id"))
                ->first();

        $printed_name = \DB::table("disbursement_voucher as dv")
                ->leftJoin("user", "dv.check_printed_name_fk", "=", "user.id")
                ->select("user.first_name", "user.middle_name", "user.last_name")
                ->where("dv.id", session()->get("pdf_dv_id"))
                ->first();

        view()->share('dv', $dv_header);
        view()->share('payee', $payee);
        view()->share('certifier', $certifier);
        view()->share('approver', $approver);
        view()->share('printed_name', $printed_name);

        $pdf = PDF::loadView('pdf.disbursement-voucher-pdf');
        return $pdf->download('DV' . $dv_header->dv_number . '.pdf');
    }    

	
}


