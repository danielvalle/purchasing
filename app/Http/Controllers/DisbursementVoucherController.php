<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\DisbursementVoucher;
use App\User;
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

        return redirect("transaction/disbursement-voucher");

    }

    public function update(Request $request)
    {

    }
	
}


