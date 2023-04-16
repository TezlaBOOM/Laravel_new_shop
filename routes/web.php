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
    Route::resource('products',App\Http\Controllers\ProductController::class);
    Route::get('/users/list',[App\Http\Controllers\UserController::class,'index'])->middleware('auth');
    Route::delete('/users/list/{user}',[App\Http\Controllers\UserController::class,'destroy'])->middleware('auth');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

});
// Route::get('/products',[ProductController::class,'index'])->name('products.index')->middleware('auth');
// 
// Route::get('/products/create',[ProductController::class,'create'])->name('products.create')->middleware('auth');
// 
// Route::get('/products/{product}', [App\Http\Controllers\ProductController::class, 'show'])->name('products.show')->middleware('auth') ;
// 
// Route::post('/products',[ProductController::class,'store'])->name('products.store')->middleware('auth');
// 
// Route::get('/products/edit/{product}',[ProductController::class,'edit'])->name('products.edit')->middleware('auth');
// 
// Route::post('/products/{product}',[ProductController::class,'update'])->name('products.update')->middleware('auth');
// 
// Route::delete('/products/{product}',[ProductController::class,'destroy'])->name('products.delete')->middleware('auth');


Route::get('/hello',[HelloWorldController::class,'show']);



