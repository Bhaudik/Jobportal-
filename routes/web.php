<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/Home', [HomeController::class, 'index'])->name('index');
Route::get('/account/login', [AccountController::class, 'login'])->name('login');
Route::get('/account/register', [AccountController::class, 'regidtretion'])->name('register');
Route::post('/account/process-register', [AccountController::class, 'proccessRegistretion'])->name('account.proccess.registretion');
Route::get('/account/profile', [AccountController::class, 'profile'])->name('profile');
Route::get('/account/logout', [HomeController::class, 'logout'])->name('logout');
