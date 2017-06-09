<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Office;
use App\Http\Controllers\Controller;

class OfficeController extends Controller
{
    
    public function index(){

        $offices = Office::all();

        return view("maintenance.maintenance-office")->with('offices', $offices);
    }

    public function store(Request $request)
    {        
        $office = Office::create(array(
                'office_name' =>trim($request->input('add-office-name')),
                'is_active' => 1
            ));

        $added = $office->save();

        return redirect('maintenance/office');
    }

    public function update(Request $request)
    {

        $office = Office::find($request->input('edit-office-id'));

        $office->office_name = trim($request->input('edit-office-name'));
        $office->save();

        return redirect('maintenance/office');
    }

    public function delete(Request $request)
    {

        $office = Office::find($request->input('del-office-id'));

        $office->is_active = 0;
        $office->save();

        return redirect('maintenance/office');
    }
    
}


