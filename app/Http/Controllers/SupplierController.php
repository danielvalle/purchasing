<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Supplier;
use App\Http\Controllers\Controller;

class SupplierController extends Controller
{
    
    public function index(){

        $suppliers = Supplier::all();

        return view("maintenance.maintenance-supplier")->with('suppliers', $suppliers);
    }

    public function store(Request $request)
    {        
        $supplier_check = \DB::table('supplier')
                    ->where('supplier_name', trim($request->input('add-supplier-name')))
                    ->first();
        
        if($supplier_check == null)
        {
            $supplier = Supplier::create(array(
                'supplier_name' => trim($request->input('add-supplier-name')),
                'is_active' => 1
            ));

            $supplier->save();

            \Session::flash('supplier_new_success', "Supplier is successfully added.");
        }
        else \Session::flash('supplier_new_fail', "Supplier already exists.");

        return redirect('maintenance/supplier');
    }

    public function update(Request $request)
    {
        $supplier_check = \DB::table('supplier')
                    ->where('supplier_name', trim($request->input('edit-supplier-name')))
                    ->first();
        
        if($supplier_check == null)
        {
            $supplier = Supplier::find($request->input('edit-supplier-id'));
            $supplier->supplier_name = trim($request->input('edit-supplier-name'));
            $supplier->save();

            \Session::flash('supplier_edit_success', trim($request->input('edit-supplier-name')) . " is successfully updated.");
            
        }
        else if($supplier_check->supplier_name == trim($request->input('edit-supplier-name')) && $supplier_check->id != $request->input('edit-supplier-id'))
        {
            \Session::flash('supplier_edit_fail', trim($request->input('edit-supplier-name')) . " already exists.");
        }

        return redirect('maintenance/supplier');
    }

    public function delete(Request $request)
    {

        $supplier = Supplier::find($request->input('del-supplier-id'));

        $supplier->is_active = 0;
        $supplier->save();

        return redirect('maintenance/supplier');
    }
    
}


