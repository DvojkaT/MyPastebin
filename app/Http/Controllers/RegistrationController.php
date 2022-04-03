<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{

    public function store()
    {
        $user = User::create(request([
            'name',
            'email',
            'password'
        ]));

        Auth::login($user);

        return redirect()->route('home');
    }
}
