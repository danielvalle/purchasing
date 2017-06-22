<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\DisbursementVoucher;
use App\User
use App\Http\Controllers\Controller;

class DisbursementVoucherController extends Controller
{
	
	public function index()
    {


		return view("transaction.transaction-disbursement-voucher");
    }

    public function store(Request $request)
    {        

    }

    public function update(Request $request)
    {

    }
	
}


