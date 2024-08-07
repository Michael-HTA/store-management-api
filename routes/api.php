<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('interest', function () {
    return response(['msg' => 100000]);
});

Route::prefix('/v1')->group(function () {
    Route::post('/login', [UserController::class, 'login']);
    Route::post('/register', [UserController::class, 'register']);
});

Route::prefix('/v1')->middleware('auth:sanctum')->group(function(){
    Route::get('/logout', [UserController::class, 'logout']);
});

Route::get('/product',[ProductController::class,'index']);
Route::get('/product/outofstock',[ProductController::class,'outOfStock']);
Route::get('/product/{id}',[ProductController::class,'show']);