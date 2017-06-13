<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Agency;
use App\Department;
use App\Http\Controllers\Controller;

class AgencyController extends Controller
{
	
	public function index(){

        $agencies = \DB::table('agency')
                ->join('department', 'agency.department_fk', '=', 'department.id')
                ->select('agency.*', 'department.department_name')
                ->get();


        $departments = Department::all();

		return view("maintenance.maintenance-agency")
            ->with('agencies', $agencies)
            ->with('departments', $departments);
	}

    public function store(Request $request)
    {        
        $agency = Agency::create(array(
                'agency_name' => trim($request->input('add-agency-name')),
                'department_fk' => $request->input('add-department'),
                'is_active' => 1
            ));

        $added = $agency->save();

        return redirect('maintenance/agency');
    }

    public function update(Request $request)
    {

    	$agency = Agency::find($request->input('edit-agency-id'));

        $agency->agency_name = trim($request->input('edit-agency-name'));
        $agency->department_fk = $request->input('edit-department');
        $agency->save();

        return redirect('maintenance/agency');
    }

    public function delete(Request $request)
    {

    	$agency = Agency::find($request->input('del-agency-id'));

        $agency->is_active = 0;
        $agency->save();

        return redirect('maintenance/agency');
    }
	
}


