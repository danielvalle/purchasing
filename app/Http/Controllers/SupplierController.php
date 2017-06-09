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
        $supplier = Supplier::create(array(
                'supplier_name' =>trim($request->input('add-supplier-name')),
                'is_active' => 1
            ));

        $added = $supplier->save();

        return redirect('maintenance/supplier');
    }

    public function update(Request $request)
    {

        $supplier = Supplier::find($request->input('edit-supplier-id'));

        $supplier->supplier_name = trim($request->input('edit-supplier-name'));
        $supplier->save();

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


