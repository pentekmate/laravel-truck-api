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

// Route::apiResource('site',SiteController::class)->middleware('auth:sanctum');
// Route::post('site',[SiteController::class,'store']);

Route::apiResource('user.site',SiteController::class)->scoped()->middleware('auth:sanctum')->except(['create','edit']);

Route::apiResource('user.sites.trucks',TruckController::class)->scoped()->except(['update','edit','destroy','store']);