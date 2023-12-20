<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;



Route::get('/',[MainController::class,'index']);
Route::get('/cart',[MainController::class,'cart']);
Route::get('/check',[MainController::class,'checkout']);
Route::get('/shop',[MainController::class,'shop']);
Route::get('/single/{id}',[MainController::class,'singleproduct']);
Route::get('/Register',[MainController::class,'Register']);
Route::post('/Registeruser',[MainController::class,'Registeruser']);
Route::get('/login',[MainController::class,'login']);
Route::post('/login',[MainController::class,'loginuser']);
Route::post('/addtocart',[MainController::class,'addtocart'])->name('addToCart');