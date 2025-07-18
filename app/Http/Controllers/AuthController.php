<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('user.login');
    }

    public function login(Request $request)
    {
         $credentials = $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required|min:3'
            ]
        );

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->route('ukm.index')->with('success','Login Succesfully, Welcome'. Auth::user()->name);
        }

        return back()->withErrors(
            [
                'email' => 'Email not found!'
            ]
        )->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('landing.index');
    }
}
