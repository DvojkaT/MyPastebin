<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function authenticate(Request $req) {
        $credentials = $req->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
    

        if (Auth::attempt($credentials)) {
            $req->session()->regenerate();

            return redirect()->intended('home');
        }
        
        return back()->withErrors([
            'email' => "Данной почты нет среди зарегестрированных",
        ]);
    }
}
