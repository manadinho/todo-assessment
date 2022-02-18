<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $validator = $request->validate([
            'email'     => 'required',
            'password'  => 'required|min:6'
        ]);
        
        $remember = ($request->has('remember')) ? true : false;
        if (\Auth::attempt($validator, $remember)) {
            return redirect()->route('home');
        }
        return back()->withInput()->with('fail', 'Credentials are not correct.');
    }

    public function logout(Request $request)
    {   
        \Auth::logout();

        return redirect()->route('home');
    }
}
