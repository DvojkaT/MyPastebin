<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    public function authenticate(LoginRequest $req) {
        $credentials = $req->validated();

        if (Auth::attempt($credentials)) {
            $req->session()->regenerate();

            return redirect()->route('home')->with('message', 'Вход выполнен успешно!');
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

        return redirect()->route('home')->with('message', 'Выход выполнен успешно!');
    }
}
