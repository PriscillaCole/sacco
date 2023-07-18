<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SaccoMemberController;

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
    return redirect(url('/login'));
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//route function to return the view for the dashboard without a controller
Route::get('/dashboard', function () {
    return view('layouts.dashboard');
});
