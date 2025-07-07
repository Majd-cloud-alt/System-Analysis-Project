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

// Route::post('/posts',function(Request $request){
//     $name=$request->input("name");
//     return response()->json(["message"=>"hello ".$name]);
// });
// Route::get('/posts',function(){
//     return response()->json(["data"=>'API']);
// });

Route::get('/',function(){
    return 'API';
});

 Route::apiResource('posts',PostController::class);
// Route::apiResource('tests',TestController::class);
Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);
Route::post('/logout',[AuthController::class,'logout'])->middleware('auth:sanctum');

Route::post('/cars', [CarController::class, 'addCar']);

Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');

























