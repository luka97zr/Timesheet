<?php

use App\Http\Controllers\ClientController;
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

// Route::get('calendar/{date}',[LogController::class,'show']);
// Route::post('calendar/{date}',[LogController::class,'show']);
Route::resource('logs',LogController::class);
Route::resource('client',ClientController::class);
Route::resource('projects',ProjectController::class);

