<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Unit;
use App\Http\Controllers\Controller;

class UnitController extends Controller
{
    
    public function index(){

        $units = Unit::all();

        return view("maintenance.maintenance-unit")->with('units', $units);
    }

    public function store(Request $request)
    {        
        $unit_check = \DB::table('unit')
                    ->where('unit_name', trim($request->input('add-unit-name')))
                    ->first();
        
        if($unit_check == null)
        {
            $unit = Unit::create(array(
                'unit_name' => trim($request->input('add-unit-name')),
                'is_active' => 1
            ));

            $unit->save();

            \Session::flash('unit_new_success', "Unit is successfully added.");
        }
        else \Session::flash('unit_new_fail', "Unit already exists.");

        return redirect('maintenance/unit');
    }

    public function update(Request $request)
    {
        $unit_check = \DB::table('unit')
                    ->where('unit_name', trim($request->input('edit-unit-name')))
                    ->first();
        
        if($unit_check == null)
        {
            $unit = Unit::find($request->input('edit-unit-id'));
            $unit->unit_name = trim($request->input('edit-unit-name'));
            $unit->save();

            \Session::flash('unit_edit_success', trim($request->input('edit-unit-name')) . " is successfully updated.");
            
        }
        else if($unit_check->unit_name == trim($request->input('edit-unit-name')) && $unit_check->id != $request->input('edit-unit-id'))
        {
            \Session::flash('unit_edit_fail', trim($request->input('edit-unit-name')) . " already exists.");
        }

        return redirect('maintenance/unit');
    }

    public function delete(Request $request)
    {

        $unit = Unit::find($request->input('del-unit-id'));

        $unit->is_active = 0;
        $unit->save();

        return redirect('maintenance/unit');
    }
    
}


