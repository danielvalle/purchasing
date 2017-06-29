<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Agency;
use App\Http\Controllers\Controller;

class AgencyController extends Controller
{
	
	public function index(){

        $agencies = Agency::all();

		return view("maintenance.maintenance-agency")
            ->with('agencies', $agencies);
	}

    public function store(Request $request)
    {        
        $agency_check = \DB::table('agency')
                    ->where('agency_name', trim($request->input('add-agency-name')))
                    ->first();
        
        if($agency_check == null)
        {
            $agency = Agency::create(array(
                'agency_name' => trim($request->input('add-agency-name')),
                'is_active' => 1
            ));

            $agency->save();

            \Session::flash('agency_new_success', "Agency is successfully added.");
        }
        else \Session::flash('agency_new_fail', "Agency already exists.");

        return redirect('maintenance/agency');
    }

    public function update(Request $request)
    {
        $agency_check = \DB::table('agency')
                    ->where('agency_name', trim($request->input('edit-agency-name')))
                    ->first();
        
        if($agency_check == null)
        {
            $agency = Agency::find($request->input('edit-agency-id'));
            $agency->agency_name = trim($request->input('edit-agency-name'));
            $agency->save();

            \Session::flash('agency_edit_success', trim($request->input('edit-agency-name')) . " is successfully updated.");
            
        }
        else if($agency_check->agency_name == trim($request->input('edit-agency-name')) && $agency_check->id != $request->input('edit-agency-id'))
        {
            \Session::flash('agency_edit_fail', trim($request->input('edit-agency-name')) . " already exists.");
        }

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


