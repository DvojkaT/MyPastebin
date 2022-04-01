<?php

use App\Http\Controllers\PastesController;
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

Route::view('/', 'home')->name('home');

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/', [PastesController::class, 'post']);
Route::get('{hash}', [PastesController::class, 'show'])->name('show');

Route::fallback(function () {
    return view('wrongpage');
});
