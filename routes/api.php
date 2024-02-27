<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//===============================AIR CONTROLLERS============================
use App\Http\Controllers\Master\AirRateMasterController;
use App\Http\Controllers\Master\SearchAirRateController;
use App\Http\Controllers\Master\FilterAirRateController;
//===============================END HERE===================================

//===============================AIR CONTROLLERS============================
Route::post('/searchairrate',[SearchAirRateController::class,'index']);
Route::post('/filterairrate',[FilterAirRateController::class,'index']);
Route::post('/addupdateairratemaster',[AirRateMasterController::class,'store']);
Route::post('/airratemasterlist',[AirRateMasterController::class,'index']);
//===============================END HERE===================================


































































































/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/
