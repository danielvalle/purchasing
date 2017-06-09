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
        $department = Department::create(array(
                'department_name' =>trim($request->input('add-department-name')),
                'is_active' => 1
            ));

        $added = $department->save();

        return redirect('maintenance/department');
    }

    public function update(Request $request)
    {

    	$department = Department::find($request->input('edit-department-id'));

        $department->department_name = trim($request->input('edit-department-name'));
        $department->save();

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


