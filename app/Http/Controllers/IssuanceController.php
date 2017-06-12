<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

use App\PurchaseRequest;
use App\PurchaseRequestDetail;
use App\User;
use App\Item;
use App\Category;
use App\Unit;
use App\Supplier;
use App\Http\Controllers\Controller;

class IssuanceController extends Controller
{
	
	public function index()
    {
		return view("transaction.transaction-issuance");
    }

    public function store(Request $request) 
    {

    }



}


