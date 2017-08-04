<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

use App\DisbursementVoucher;
use App\DisbursementVoucherDetail;
use App\DisbursementVoucherAccounting;
use App\User;
use App\Designation;
use App\Item;
use App\Entity;
use App\Http\Controllers\Controller;

class DisbursementVoucherController extends Controller
{
	
	public function index()
    {
        $users = User::all();
        $designations = Designation::all();
        $entities = Entity::all();
        
		return view("transaction.transaction-disbursement-voucher")
                ->with("users", $users)
                ->with("designations", $designations)
                ->with("entities", $entities);
    }

    public function store(Request $request)
    {        
        $detail_count = $request->input("hdn-detail-quantity");
        $acc_count = $request->input("hdn-acc-quantity");

        $disbursement_voucher = DisbursementVoucher::create(array(
                'mode_of_payment' => $request->input('add-mode-of-payment'),
                'others' => $request->input('add-others'),
                'date' => date("Y-m-d"),
                'entity_fk' => $request->input('add-entity'),
                'fund_cluster' => $request->input('add-fund-cluster'),
                'payee_fk' => $request->input('add-payee'),
                'employee_no' => $request->input('add-tin'),
                'ors_bur_no' => $request->input('add-ors-bur-no'),
                'address' => $request->input('add-address'),
                'certified' => $request->input('add-certified'),
                'certifier_fk' => $request->input('add-certifier'),
                'certifier_designation_fk' => $request->input('add-certifier-designation'),
                'certifier_expense_fk' => $request->input('add-certifier-expense'),
                'certifier_expense_designation_fk' => $request->input('add-certifier-expense-designation'),
                'certified_date' => $request->input('add-certified-date') != '' ? date("Y-m-d", strtotime($request->input('add-certified-date'))) : null,
                'approved_for_payment' => $request->input('add-approved-for-payment'),
                'approver_fk' => $request->input('add-approver'),
                'approver_designation_fk' => $request->input('add-approver-designation'),
                'approve_date' => $request->input('add-approved-date') != '' ? date("Y-m-d", strtotime($request->input('add-approved-date'))) : null,
                'ada_no' => $request->input('add-check-ada'),
                'payment_check_date' => $request->input('add-check-date') != '' ? date("Y-m-d", strtotime($request->input('add-check-date'))) : null,
                'bank_name' => $request->input('add-bank'),
                'jev_no' => $request->input('add-jev-no'),
                'check_printed_name_fk' => $request->input('add-printed-name'),
                'check_date' => $request->input('add-printed-name-date') != '' ? date("Y-m-d", strtotime($request->input('add-printed-name-date'))) : null,
                'other_docs' => $request->input('add-documents'),
                'is_active' => 1
            ));
    
        $disbursement_voucher->save();

        for($i = 0; $i < $detail_count; $i++)
        {
            $dv_detail = DisbursementVoucherDetail::create(array(
                'dv_fk' => $disbursement_voucher->id,
                'particulars' => $request->input("hdn-particulars")[$i],
                'responsibility_center' => $request->input("hdn-responsibility-center")[$i],
                'mfo_pap' => $request->input("hdn-mfo-pap")[$i],
                'amount' => $request->input("hdn-amount")[$i]
            )); 

            $dv_detail->save();
        }

        for($i = 0; $i < $acc_count; $i++)
        {
            $dv_acc = DisbursementVoucherAccounting::create(array(
                'dv_fk' => $disbursement_voucher->id,
                'accounting_title' => $request->input("hdn-accounting-title")[$i],
                'uacs_code' => $request->input("hdn-uacs")[$i],
                'debit' => $request->input("hdn-debit")[$i],
                'credit' => $request->input("hdn-credit")[$i]
            ));

            $dv_acc->save();
        }

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
                ->leftJoin("entity as e", "disbursement_voucher.entity_fk", "=", "e.id")
                ->select("mode_of_payment", "employee_no", "ors_bur_no", "address", "dv_number",
                         "certified", "certified_date", "approved_for_payment",  "approve_date",
                         "ada_no", "payment_check_date", "bank_name", "jev_no", "date",
                         "check_date", "other_docs", "fund_cluster",  "e.entity_name", "others")
                ->where("disbursement_voucher.id", session()->get("pdf_dv_id"))
                ->first();

        $dv_detail = \DB::table("disbursement_voucher_detail as dvd")
                ->leftJoin("disbursement_voucher as dv", "dvd.dv_fk", "=", "dv.id")
                ->where("dv.id", session()->get("pdf_dv_id"))
                ->select("*")->get();

        $dv_acc = \DB::table("disbursement_voucher_accounting as dva")
                ->leftJoin("disbursement_voucher as dv", "dva.dv_fk", "=", "dv.id")
                ->where("dv.id", session()->get("pdf_dv_id"))
                ->select("*")->get();

        $payee = \DB::table("disbursement_voucher as dv")
                ->leftJoin("user", "dv.payee_fk", "=", "user.id")
                ->select("user.first_name", "user.middle_name", "user.last_name")
                ->where("dv.id", session()->get("pdf_dv_id"))
                ->first();

        $certifier = \DB::table("disbursement_voucher as dv")
                ->leftJoin("user", "dv.certifier_fk", "=", "user.id")
                ->leftJoin("designation", "dv.certifier_expense_designation_fk", "=", "designation.id")
                ->select("user.first_name", "user.middle_name", "user.last_name", "designation.designation_name")
                ->where("dv.id", session()->get("pdf_dv_id"))
                ->first();

        $certifier_expense = \DB::table("disbursement_voucher as dv")
                ->leftJoin("user", "dv.certifier_expense_fk", "=", "user.id")
                ->leftJoin("designation", "dv.certifier_expense_designation_fk", "=", "designation.id")
                ->select("user.first_name", "user.middle_name", "user.last_name", "designation.designation_name")
                ->where("dv.id", session()->get("pdf_dv_id"))
                ->first();

        $approver = \DB::table("disbursement_voucher as dv")
                ->leftJoin("user", "dv.approver_fk", "=", "user.id")
                ->leftJoin("designation", "dv.certifier_expense_designation_fk", "=", "designation.id")
                ->select("user.first_name", "user.middle_name", "user.last_name", "designation.designation_name")
                ->where("dv.id", session()->get("pdf_dv_id"))
                ->first();

        $printed_name = \DB::table("disbursement_voucher as dv")
                ->leftJoin("user", "dv.check_printed_name_fk", "=", "user.id")
                ->select("user.first_name", "user.middle_name", "user.last_name")
                ->where("dv.id", session()->get("pdf_dv_id"))
                ->first();
        
        view()->share('dv', $dv_header);
        view()->share('dvd', $dv_detail);
        view()->share('dva', $dv_acc);
        view()->share('payee', $payee);
        view()->share('certifier', $certifier);
        view()->share('certifier_expense', $certifier_expense);
        view()->share('approver', $approver);
        view()->share('printed_name', $printed_name);

        $pdf = PDF::loadView('pdf.disbursement-voucher-pdf');
        return $pdf->download('DV' . $dv_header->dv_number . '.pdf');
    }    

	
}


