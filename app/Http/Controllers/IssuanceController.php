<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

use App\PurchaseRequest;
use App\PurchaseRequestDetail;
use App\Agency;
use App\Department;
use App\Office;
use App\Designation;
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
    	$agencies = Agency::all();
    	$departments = Department::all();
    	$offices = Office::all();
    	$users = User::all();
    	$designations = Designation::all();

    	$items = Item::all();
    	$units = Unit::all();

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

    }

    public function add_item(Request $request)
    {
    	$selected_item = \DB::table('item')
    				->select('*')
    				->where('id', $request->input('item_id'))
    				->first();

    	$selected_unit = \DB::table('unit')
    				->select('*')
    				->where('id', $request->input('unit_id'))
    				->first();


        if($request->ajax()){

            return $request->json(array(
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



}


