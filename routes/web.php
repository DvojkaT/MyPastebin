<?php

use App\Http\Controllers\PastesController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function() {
    return view('home');
})->name('home');
Route::post('/', [PastesController::class, 'post']);
Route::get('/{hash}', [PastesController::class, 'show'])->name('show');

Route::get('/mypastes', function(){
    return view('mypastes');
})->name('mypastes');

Route::get('/user/register', function() {
    return view('Auth.register');
})->name('register');

Route::post('/user/register/submit', [RegistrationController::class, 'store'])->name('submitregister');

Route::get('/user/login', function () {
    return view('Auth.Login');
})->name('login');

Route::post('/user/login/submit', [LoginController::class, 'authenticate'])->name('submitlogin');

Route::get('/user/logout', [LoginController::class, 'logout'])->name('logout');

Route::fallback(function () {
    return view('wrongpage');
});
