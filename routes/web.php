<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    dd(auth()->user());
    return view('home');
})->middleware('auth');

Route::get('/signup', function () {
    return view('signup');
})->middleware('guest')->name('signup');

Route::get('/login', function () {
    return view('login');
})->middleware('guest')->name('login');