<?php

use App\Http\Controllers\api\SiteController;
use App\Http\Controllers\api\TruckController;
use Illuminate\Support\Facades\Route;

    // Route::get('/user', function (Request $request) {
    //     return $request->user();
    // })->middleware('auth:sanctum');


Route::apiResource('site',SiteController::class);
Route::post('site',[SiteController::class,'store']);

Route::apiResource('sites.trucks',TruckController::class)->scoped()->except(['update','edit','destroy','store']);