<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Department;
use App\Http\Controllers\Controller;

class DepartmentController extends Controller
{
	
	public function index(){

		$departments = Department::all();

		return view("maintenance.maintenance-department")->with('departments', $departments);
	}

    public function store(Request $request)
    {      
        $department_check = \DB::table('department')
                    ->where('department_name', trim($request->input('add-department-name')))
                    ->first();
        
        if($department_check == null)
        {
            $department = Department::create(array(
                    'department_name' =>trim($request->input('add-department-name')),
                    'is_active' => 1
                ));

            $department->save();

            \Session::flash('department_new_success', "Department is successfully added.");
        }
        else \Session::flash('department_new_fail', "Department already exists.");


        return redirect('maintenance/department');
    }

    public function update(Request $request)
    {
        $department_check = \DB::table('department')
                    ->where('department_name', trim($request->input('edit-department-name')))
                    ->first();
        
        if($department_check == null)
        {
            $department = Department::find($request->input('edit-department-id'));

            $department->department_name = trim($request->input('edit-department-name'));
            $department->save();

            \Session::flash('department_edit_success', trim($request->input('edit-department-name')) . " is successfully updated.");
        }
        else if($department_check->department_name == trim($request->input('edit-department-name')) && $department_check->id != $request->input('edit-department-id'))
        {      
            \Session::flash('department_edit_fail', trim($request->input('edit-department-name')) . " already exists.");
        }

        return redirect('maintenance/department');
    }

    public function delete(Request $request)
    {

    	$department = Department::find($request->input('del-department-id'));

        $department->is_active = 0;
        $department->save();

        return redirect('maintenance/department');
    }
	
}


