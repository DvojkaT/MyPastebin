<?php

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

Route::get('/', function () {
    return view('home');
})->name('newpasta');

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/submit', function() {
    return "OK";
})->name('submitpasta');

Route::post('/register/submit', function() {
    return "Registered";
})->name('submitregister');

Route::post('/login/submit', function(){
    return "Succesfull login";
})->name('submitlogin');

Route::fallback(function () {
    return view('wrongpage');
});
