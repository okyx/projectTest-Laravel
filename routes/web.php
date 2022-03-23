<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\API_Controller;
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

//FUNCTION GENERAL
Route::get('login', [LoginController::class, "index"])->name('login');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('register', [LoginController::class, "register"]);
Route::post('signUp', [LoginController::class, "signUp"])->name('signUp');
Route::post('signIn', [LoginController::class, "signIn"])->name('signIn');

//API
Route::get('login_API', [API_Controller::class, "login_API"])->name('login_API');
Route::post('register_API', [API_Controller::class, "register_API"])->name('register_API');
Route::get('getUser_API', [API_Controller::class, "getUser_API"])->name('getUser_API');

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('layouts.index');
    })->name('/');
    Route::resource('admin', AdminController::class);
});
