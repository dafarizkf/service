<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Encryption\DecryptException;

class KelolaAkun extends Controller
{
    public function ViewKelolaAkun()
    {
    	$users = User::all();

    	return view('administrator.kelola_akun', compact('users'));
    }

    public function SimpanAkun(Request $request)
    {
    	$users = new User;
    	$users->name = $request->name;
    	$users->role = $request->role;
    	$users->username = $request->username;
    	$users->password = Hash::make($request->password);
    	$users->remember_token = Str::random(40);
    	$users->save();

    	return redirect()->back();
    }

    public function HapusAkun($id)
    {
    	User::destroy($id);

    	return redirect()->back();
    }
}