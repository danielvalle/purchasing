<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

use App\PurchaseOrder;
use App\PurchaseOrdertDetail;
use App\User;
use App\Department;
use App\Item;
use App\Category;
use App\Unit;
use App\Supplier;
use App\Http\Controllers\Controller;

class AcceptanceController extends Controller
{
	
	public function index()
    {
    	$po_nos = PurchaseOrder::all();
    	$departments = Department::all();
    	$users = User::all();

		return view("transaction.transaction-acceptance")
				->with("po_nos", $po_nos)
				->with("departments", $departments)
				->with("users", $users);
    }

    public function store(Request $request) 
    {

    }

    public function get_po(Request $request)
    {

    }



}


