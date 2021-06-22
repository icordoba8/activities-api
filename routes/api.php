<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActivitiesController;
use App\Http\Controllers\TimeActivityController;
use App\Http\Controllers\LoginController;
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

Route::post('login', [LoginController::class,"login"]);

Route::group(['middleware' =>['cors','auth:sanctum']], function()
{
    Route::apiResource('activities', ActivitiesController::class);
    Route::apiResource('/times', TimeActivityController::class);
    Route::get('times/activity/{id}', [TimeActivityController::class,"index"]);
    Route::post('/logout', [LoginController::class,"logout"]);
});



