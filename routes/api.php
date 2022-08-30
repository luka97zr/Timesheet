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
use App\Http\Controllers\ReportController;
use App\Http\Controllers\Admin\ResetPasswordController;
use App\Http\Controllers\CategoryProjectController;
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
Route::post('password/forgot', ResetPasswordController::class);
Route::prefix('verify')->group(function() {
    Route::get('/', [VerifyUserController::class,'index']);
    Route::post('/user/create', [VerifyUserController::class, 'store']);
});
Route::group(['middleware' => 'auth:api'], function() {
    Route::get('user',[JWTAuthController::class, 'getUser']);
    Route::get('logout', [JWTAuthController::class, 'logout']);
    Route::apiResource('logs',LogController::class);
    Route::get('user/project',[UserProjectController::class, 'index']);
    Route::get('calendar/{from}/{to}',CalendarController::class);
    Route::prefix('report')->group(function() {
        Route::post('/', [ReportController::class, 'index']);
        Route::post('/clients', [ReportController::class, 'userClients']);
        Route::post('/category', [ReportController::class, 'projectCategory']);
        Route::post('/generate', [ReportController::class, 'generateReport']);
        Route::post('/export', [ReportController::class, 'export']);
    });

    Route::middleware(['admin'])->group(function() {
        Route::get('client/all',[ClientController::class, 'allClients']);
        Route::get('client/alphabet',[ClientController::class, 'getAlphabet']);
        Route::apiResource('client',ClientController::class);
        Route::get('project/all',[ProjectController::class, 'allProjects']);
        Route::get('project/alphabet',[ProjectController::class, 'getAlphabet']);
        Route::apiResource('project',ProjectController::class);
        Route::post('/categoryProject', [CategoryProjectController::class, 'index']);
        Route::get('country',CountryController::class);
        Route::post('user/project',[UserProjectController::class, 'show']);
        Route::post('user/project/store',[UserProjectController::class, 'store']);
        Route::post('password/change',[ChangePasswordController::class, 'store']);
        Route::apiResource('employee',EmployeeController::class);
        Route::get('leads',LeadController::class);
        Route::get('category/alphabet',[CategoryController::class, 'getAlphabet']);
        Route::apiResource('category',CategoryController::class);
        Route::get('role', RoleController::class);
    });
});
