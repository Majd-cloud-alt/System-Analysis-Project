<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/',function(){
    return 'API';
});

 Route::apiResource('posts',PostController::class);
// Route::apiResource('tests',TestController::class);
Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);
Route::post('/logout',[AuthController::class,'logout'])->middleware('auth:sanctum');

   Route::get('/cars', [CarController::class, 'index']);
   
Route::middleware(['auth:sanctum'])->group(function () {
    Route::put('/cars/{id}', [CarController::class, 'update']);
    Route::delete('/cars/{id}', [CarController::class, 'destroy']);
Route::post('/cars', [CarController::class, 'addCar']);
Route::post('/cart/add/{id}', [CarController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CarController::class, 'showCart'])->name('cart.show');


});























