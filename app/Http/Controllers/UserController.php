<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Agency;
use App\Designation;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    
    public function index(){

        $users = \DB::table('user')
                ->join('agency', 'user.agency_fk', '=', 'agency.id')
                ->join('designation', 'user.designation_fk', '=', 'designation.id')
                ->select('user.*', 'agency.agency_name', 'designation.designation_name')
                ->get();

        $agencies = Agency::all();
        $designations = Designation::all();

        return view("maintenance.maintenance-user")
            ->with('users', $users)
            ->with('agencies', $agencies)
            ->with('designations', $designations);
    }

    public function store(Request $request)
    {        
        $user_check = \DB::table('user')
                    ->where('email', trim($request->input('add-email')))
                    ->first();

        if($user_check == null)
        {      
            $user = User::create(array(
                    'first_name' => trim($request->input('add-first-name')),
                    'last_name' => trim($request->input('add-last-name')),
                    'middle_name' => trim($request->input('add-middle-name')),
                    'suffix' => trim($request->input('add-suffix')),
                    'sex' => trim($request->input('add-sex')),
                    'email' => trim($request->input('add-email')),
                    'birthday' =>  date("Y-m-d", strtotime($request->input('add-birthday'))),
                    'password' => trim($request->input('add-password')),
                    'agency_fk' => trim($request->input('add-agency')),
                    'user_type' => trim($request->input('add-type')),
                    'designation_fk' => trim($request->input('add-designation')),
                    'is_active' => 1
                ));

            $added = $user->save();

            \Session::flash('user_new_success', "User is successfully added.");
        }
        else \Session::flash('user_new_fail', "E-mail already exists.");
        
        return redirect('maintenance/user');
    }

    public function update(Request $request)
    {
        $user_check = \DB::table('user')
                    ->where('email', trim($request->input('edit-email')))
                    ->first();
        
        if($user_check == null)
        {
            $user = User::find($request->input('edit-user-id'));

            $user->first_name = trim($request->input('edit-first-name'));
            $user->last_name = trim($request->input('edit-last-name'));
            $user->middle_name = trim($request->input('edit-middle-name'));
            $user->suffix = trim($request->input('edit-suffix'));
            $user->sex = trim($request->input('edit-sex'));
            $user->email = trim($request->input('edit-email'));
            $user->birthday = date("Y-m-d", strtotime($request->input('edit-birthday')));
            $user->password = trim($request->input('edit-password'));
            $user->agency_fk = trim($request->input('edit-agency'));
            $user->user_type = trim($request->input('edit-type'));
            $user->designation_fk = trim($request->input('edit-designation'));
            $user->save();

            \Session::flash('user_edit_success', "User is successfully updated.");
        }
        else if($user_check->email == trim($request->input('edit-email')) && $user_check->id != $request->input('edit-user-id'))
        {
            \Session::flash('user_edit_fail', trim($request->input('edit-email')) . " already exists.");
        }

        return redirect('maintenance/user');
    }

    public function delete(Request $request)
    {

        $user = User::find($request->input('del-user-id'));

        $user->is_active = 0;
        $user->save();

        return redirect('maintenance/user');
    }
    
}


