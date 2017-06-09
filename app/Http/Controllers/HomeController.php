<?php

namespace App\Http\Controllers;

use View;
use Input;
use App\User;
use Illuminate\Support\Facades\Mail;
use Redirect;
use Illuminate\Http\Request;
use Validator;
use Auth;
use Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
	
	public function index()
	{

		return view("layouts.master");

	}

	public function login(Request $request)
	{

    	$rules = [
            'email' => 'required|exists:user',
            'password' => 'required'
        ];

        $input = Input::only('email', 'password');

        $validator = Validator::make($input, $rules);
        if($validator->fails())
        {
        	dd("hm");
            return Redirect::back()->withInput(Input::except('password'))->withErrors($validator, 'login');
        }

        $email = Input::get('email');
        $pass = Input::get('password');

        if (Auth::attempt(['email' => $email, 'password' => $pass])) {
        dd($email);
            // Authentication passed...
            $user = User::where('email', '=', Input::get('email'))->first();
  
            if(Auth::user()->type == 0){
                return redirect()->intended('transaction/purchase-request');
            }else if(Auth::user()->type == 1){
                return redirect()->intended('transaction/purchase-request');
            }
            
        }else{
            dd("hmm :>");
        }
	}
	
}


