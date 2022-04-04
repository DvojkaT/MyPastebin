<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function authenticate(Request $req) {
        $credentials = $req->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $req->session()->regenerate();

            return redirect()->route('home');
        }
        else
        {
            return redirect()->back()->withErrors(['Неверные данные!']);
        }
    }

    public function logout()
    {
        Session::flush();
        
        Auth::logout();

        return redirect()->route('home');
    }
}
