<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

use App\Agency;
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

class PurchaseOrderController extends Controller
{
    
    public function index()
    {
    	$agencies = Agency::all();
    	$users = User::all();


        return view("transaction.transaction-purchase-order")
        	->with("agencies", $agencies)
        	->with("users", $users);
    }

    public function store(Request $request) 
    {

    }

}


