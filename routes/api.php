<?php

use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\JWTAuthController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserProjectController;
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


Route::resource('logs',LogController::class);
Route::resource('client',ClientController::class);
Route::resource('projects',ProjectController::class);
Route::get('calendar/{from}/{to}',CalendarController::class);

Route::post('login',[JWTAuthController::class, 'login']);
Route::post('user',[JWTAuthController::class, 'getUser']);
Route::group(['middleware' => 'auth.jwt'], function() {
    Route::post('logout', [JWTAuthController::class, 'logut']);
});
