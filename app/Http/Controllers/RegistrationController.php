<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\RegisterRequest;
use App\Services\Abstracts\UserServiceInterface;

class RegistrationController extends Controller
{
    public UserServiceInterface $service;

    public function __construct(UserServiceInterface $service)
    {
        $this->service = $service;
    }

    public function store(RegisterRequest $request)
    {
        $user = $this->service->createUser($request->validated());

        Auth::login($user);

        return redirect()->route('home')->with('message', 'Регистрация выполнена успешно!');
    }
}
