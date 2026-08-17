<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WarehouseController;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Controllers\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/products', [ProductController::class, 'index']);
Route::post('/products', [ProductController::class, 'store']);
Route::put('/products/{id}',[ProductController::class,'update']);
Route::delete('/products',[ProductController::class,'delete']);

Route::get('/warehouses', [WarehouseController::class, 'index']);
Route::post('/warehouses', [WarehouseController::class,'store']);
Route::put('/warehouses/{id}', [WarehouseController::class,'update']);
Route::get('/warehouses/{id}', [WarehouseController::class,'show']);
Route::delete('/warehouses/{id}', [WarehouseController::class,'destroy']);
//

Route::post('/register',AuthController::class,'register');
Route::post('/login',AuthController::class,'login');
Route::post('/logout',AuthController::class,'logout')->middleware('auth:sanctum');
