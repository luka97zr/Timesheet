<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ChangePasswordController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\LeadController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\VerifyUserController;
use App\Http\Controllers\User\CalendarController;
use App\Http\Controllers\User\LogController;
use App\Http\Controllers\User\UserProjectController;
use App\Http\Controllers\JWTAuthController;
use App\Models\Category;
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

Route::post('login',[JWTAuthController::class, 'login']);
Route::post('password/change',[ChangePasswordController::class, 'store']);
Route::prefix('verify')->group(function() {
    Route::get('/', [VerifyUserController::class,'index']);
    Route::post('/user/create', [VerifyUserController::class, 'store']);
});
Route::group(['middleware' => 'auth:api'], function() {
    Route::get('user',[JWTAuthController::class, 'getUser']);
    Route::get('logout', [JWTAuthController::class, 'logout']);
    Route::apiResource('logs',LogController::class);
    Route::apiResource('user/project/',UserProjectController::class);
    Route::get('calendar/{from}/{to}',CalendarController::class);

    Route::middleware(['admin'])->group(function() {
        Route::get('client/all',[ClientController::class, 'allClients']);
        Route::apiResource('client',ClientController::class);
        Route::apiResource('country',CountryController::class);
        Route::get('project/all',[ProjectController::class, 'allProjects']);
        Route::apiResource('project',ProjectController::class);
        Route::apiResource('employee',EmployeeController::class);
        Route::get('leads',LeadController::class);
        Route::apiResource('category',CategoryController::class);
        Route::get('role', RoleController::class);
    });
});
