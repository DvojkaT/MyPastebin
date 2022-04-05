<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\RegisterRequest;

class RegistrationController extends Controller
{

    public function store(RegisterRequest $request)
    {
        $user = User::create(request([
            'name',
            'email',
            'password'
        ]));

        Auth::login($user);

        return redirect()->route('home')->with('message', 'Регистрация выполнена успешно!');
    }
}
