<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\SiteController;
use App\Http\Controllers\api\TruckController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::post('/login', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::post('/login',[AuthController::class,'login']);



Route::apiResource('user.site',SiteController::class)->scoped()->except(['edit','create']);

Route::apiResource('user.sites.trucks',TruckController::class)->scoped()->except(['update','edit','destroy','store']);