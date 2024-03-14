<?php

use App\Http\Controllers\API\CustomerController;
use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\MedicinController;
use App\Http\Middleware\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('/login',[LoginController::class, 'login'])->name('login');

Route::middleware('auth:api')->group(function () {
    Route::get('/user', [LoginController::class, 'user']);
    Route::post('/logout', [LoginController::class, 'logout']);

    //Owner Access
    Route::group(['middleware' => [UserRole::class . ':Owner']], function () {
        Route::post('/customers/store', [CustomerController::class, 'store'])->name('store');
        Route::delete('/customers/{id}', [CustomerController::class, 'destroy']);

        Route::post('/medicin/store', [MedicinController::class, 'store'])->name('store');
        Route::delete('/medicin/{id}', [MedicinController::class, 'destroy']);

    });

    //All Role Access
        Route::get('/customers', [CustomerController::class, 'index']);
        Route::post('/customers/{id}', [CustomerController::class, 'update']);

        Route::get('/medicin', [MedicinController::class, 'index']);
        Route::post('/medicin/{id}', [MedicinController::class, 'update']);

        //Manager Access
        Route::group(['middleware' => [ UserRole::class . ':Managers']], function () {
             Route::delete('/customers/delete/{id}', [CustomerController::class, 'destroyManager']);
             Route::delete('/medicin/delete/{id}', [MedicinController::class, 'destroyManager']);
    });
});


