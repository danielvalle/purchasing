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
        $designation = Designation::create(array(
                'designation_name' =>trim($request->input('add-designation-name')),
                'is_active' => 1
            ));

        $added = $designation->save();

        return redirect('maintenance/designation');
    }

    public function update(Request $request)
    {

    	$designation = Designation::find($request->input('edit-designation-id'));

        $designation->designation_name = trim($request->input('edit-designation-name'));
        $designation->save();

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


