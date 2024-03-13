<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['middleware' => [UserRole::class . ':admin']], function () {
    // Routes accessible only to users with the 'admin' role
    // ...
});

Route::group(['middleware' => [UserRole::class . ':moderator']], function () {
    // Routes accessible only to users with the 'moderator' role
    // ...
});
