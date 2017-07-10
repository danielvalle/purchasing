<?php

namespace App\Http\Controllers;

use View;
use Input;
use App\User;
use Redirect;
use Illuminate\Http\Request;
use Validator;
use Auth;
use Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Hash;
use DB;

use App\Agency;
use App\Department;
use App\Designation;

class HomeController extends Controller
{
	
	public function index()
	{
        $agencies = Agency::all();
        $departments = Department::all();
        $designations = Designation::all();

        return view("login")
                ->with('agencies', $agencies)
                ->with('departments', $departments)
                ->with('designations', $designations);
		//return view("layouts.master");

	}

	public function LogIn(Request $request)
	{

    	$rules = [
            'email' => 'required|exists:user',
            'password' => 'required'
        ];

        $input = Input::only('email', 'password');

        $user = User::first();

        $validator = Validator::make($input, $rules);

        if($validator->fails())
        {   
            return Redirect::back()->withInput(Input::except('password'))->withError($validator, 'login');
        }
        else
        {
            $user = array(
                'email' => Input::get('email'),
                'password' => Input::get('password')
            );
            
            //dd($user);

            if (Auth::attempt($user, true)) 
            {
                // Authentication passed...
                $user = User::where('email', '=', Input::get('email'))->first();

                session(['logged-user' => $user]);

                if(Auth::user()->user_type == 0){
                    return redirect()->intended('transaction/purchase-request');
                }else if(Auth::user()->user_type == 1){
                    return redirect()->intended('transaction/request-for-quotation');
                }
                
            }
            else
            {
                return redirect('/')->with('login_error', 'Email and password do not match.')
                    ->withInput(Input::except('password'));
            }
        }
	}

    public function LogOut()
    {    
        //if(Auth::check())
        //{   
            session()->flush();
            Auth::logout();
            return redirect('/');
        //}
    }

    public function change_password(Request $request)
    {
        $user = session()->get('logged-user');

        $old = $request->input('old-password');
        $new = $request->input('new-password'); 
        $confirm = $request->input('confirm-password');

        Session::flash('change_pw', 'change');

        if (Hash::check($old, $user->password))
        {
            if($new == $confirm)
            {
                return redirect()->back()->with('new_success', 'Password successfully changed.');
            }
            else
            {
                return redirect()->back()->with('confirm_error', 'Confirm password does not match.')
                                         ->withInput(Input::all());
            }
        }
        else
        {
            return redirect()->back()->with('old_error', 'Old password does not match.')
                                     ->withInput(Input::all());
        }
    }
	
}


