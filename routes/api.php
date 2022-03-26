<?php

use App\Http\Controllers\API_Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//ROUTE API
Route::post('login_API', [API_Controller::class, "login_API"])->name('login_API');
Route::post('register_API', [API_Controller::class, "register_API"])->name('register_API');
Route::get('getUser_API', [API_Controller::class, "getUser_API"])->name('getUser_API');
