<?php

use App\Http\Controllers\HelloWorldController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Auth::routes(['verify' => true]);
Route::get('/',[WelcomeController::class,'index']);
Route::middleware(['auth','verified'])->group(function (){
    Route::middleware(['can:isAdmin'])->group(function (){
         Route::resource('products',App\Http\Controllers\ProductController::class);
         Route::get('/users/list',[App\Http\Controllers\UserController::class,'index']);
         Route::delete('/users/list/{user}',[App\Http\Controllers\UserController::class,'destroy']);
    });
         

     });

     Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
     Route::post('/cart/{product}', [App\Http\Controllers\CartController::class, 'store'])->name('cart.store');
     Route::get('/cart/list', [App\Http\Controllers\CartController::class, 'index'])->name('cart.index');

Route::get('/hello',[HelloWorldController::class,'show']);



