<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Designation;
use App\Http\Controllers\Controller;

class DesignationController extends Controller
{
	
	public function index(){

		$designations = Designation::all();

		return view("maintenance.maintenance-designation")->with('designations', $designations);
	}

    public function store(Request $request)
    {        
        $designation_check = \DB::table('designation')
                    ->where('designation_name', trim($request->input('add-designation-name')))
                    ->first();
        
        if($designation_check == null)
        {
            $designation = Designation::create(array(
                'designation_name' => trim($request->input('add-designation-name')),
                'is_active' => 1
            ));

            $designation->save();

            \Session::flash('designation_new_success', "Designation is successfully added.");
        }
        else \Session::flash('designation_new_fail', "Designation already exists.");

        return redirect('maintenance/designation');
    }

    public function update(Request $request)
    {
        $designation_check = \DB::table('designation')
                    ->where('designation_name', trim($request->input('edit-designation-name')))
                    ->first();
        
        if($designation_check == null)
        {
            $designation = Designation::find($request->input('edit-designation-id'));
            $designation->designation_name = trim($request->input('edit-designation-name'));
            $designation->save();

            \Session::flash('designation_edit_success', trim($request->input('edit-designation-name')) . " is successfully updated.");
            
        }
        else if($designation_check->designation_name == trim($request->input('edit-designation-name')) && $designation_check->id != $request->input('edit-designation-id'))
        {
            \Session::flash('designation_edit_fail', trim($request->input('edit-designation-name')) . " already exists.");
        }

        return redirect('maintenance/designation');
    }

    public function delete(Request $request)
    {

    	$designation = Designation::find($request->input('del-designation-id'));

        $designation->is_active = 0;
        $designation->save();

        return redirect('maintenance/designation');
    }
	
}


