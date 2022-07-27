<?php

use App\Http\Controllers\DeviceController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\TravelController;
use App\Http\Controllers\TrakinController;
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

Route::resource('device', DeviceController::class)->except(['create','edit']);
Route::resource('route', RouteController::class)->except(['create','edit']);
Route::resource('travel', TravelController::class)->except(['create','edit']);
Route::resource('trakin', TrakinController::class)->except(['create','edit']);

Route::get('findByCode/{code}', [TravelController::class,'findByCode']);
Route::get('findLastTrakinByCode/{code}', [TravelController::class,'findLastTrakinByCode']);
Route::get('getTrackinByTravel/{code}', [TrakinController::class,'getTrackinByTravel']);

