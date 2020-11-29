<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function ViewLogin()
    {
    	return view('login');
    }

    public function CekLogin(Request $request)
    {
    	if(Auth::attempt($request->only('username','password'))){
    		return redirect('/dashboard');
    	}

    	return redirect('/login');
    }

    public function Logout()
    {
    	Auth::logout();

    	return redirect('/login');
    }
}