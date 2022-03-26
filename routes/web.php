<?php

use App\Http\Controllers\AdminController;
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



//ROUTE GENERAL
Route::get('login', [LoginController::class, "index"])->name('login');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('register', [LoginController::class, "register"]);
Route::post('signUp', [LoginController::class, "signUp"])->name('signUp');
Route::post('signIn', [LoginController::class, "signIn"])->name('signIn');

Route::middleware(['checkAuth','Revalidate'])->group(function () {
    Route::get('/', function () {
        return view('login.login');
    })->name('/');
    Route::resource('admin', AdminController::class);
});
