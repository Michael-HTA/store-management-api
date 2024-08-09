<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\StockController;
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
    Route::put('/products/{id}',[ProductController::class,'update']);
});

Route::get('/products',[ProductController::class,'index']);
Route::post('/products',[ProductController::class,'store']);
Route::get('/products/out-of-stock',[StockController::class,'outOfStock']);
Route::get('/products/{id}',[ProductController::class,'show']);
Route::delete('/products/{id}',[ProductController::class,'delete']);
Route::post('/sales',[SaleController::class,'processSale']);


