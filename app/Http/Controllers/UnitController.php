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
        $unit = Unit::create(array(
                'unit_name' =>trim($request->input('add-unit-name')),
                'is_active' => 1
            ));

        $added = $unit->save();

        return redirect('maintenance/unit');
    }

    public function update(Request $request)
    {

        $unit = Unit::find($request->input('edit-unit-id'));

        $unit->unit_name = trim($request->input('edit-unit-name'));
        $unit->save();

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


