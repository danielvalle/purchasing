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
        $office_check = \DB::table('office')
                    ->where('office_name', trim($request->input('add-office-name')))
                    ->first();
        
        if($office_check == null)
        {
            $office = Office::create(array(
                'office_name' => trim($request->input('add-office-name')),
                'is_active' => 1
            ));

            $office->save();

            \Session::flash('office_new_success', "Office is successfully added.");
        }
        else \Session::flash('office_new_fail', "Office already exists.");

        return redirect('maintenance/office');
    }

    public function update(Request $request)
    {
        $office_check = \DB::table('office')
                    ->where('office_name', trim($request->input('edit-office-name')))
                    ->first();
        
        if($office_check == null)
        {
            $office = Office::find($request->input('edit-office-id'));
            $office->office_name = trim($request->input('edit-office-name'));
            $office->save();

            \Session::flash('office_edit_success', trim($request->input('edit-office-name')) . " is successfully updated.");
            
        }
        else if($office_check->office_name == trim($request->input('edit-office-name')) && $office_check->id != $request->input('edit-office-id'))
        {
            \Session::flash('office_edit_fail', trim($request->input('edit-office-name')) . " already exists.");
        }

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


