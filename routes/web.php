<?php

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

/*Route::get('/', function () {
    return view('welcome2');

});
*/
Route::get('/', [App\Http\Controllers\WelcomeController::class, 'index']) ;


Route::middleware(['auth','verified'])->group(function(){
    Route::resource('products', App\Http\Controllers\ProductController::class)->middleware('can:isAdmin') ;


    Route::get('/users/list', [App\Http\Controllers\UserController::class, 'index'])->middleware('can:isAdmin') ;
    Route::delete('/users/list/{id}',[App\Http\Controllers\UserController::class,'destroy'])->middleware('can:isAdmin');

});


Auth::routes(['verify'=> true]);
//Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->name('products.index')->middleware('auth')->middleware('')  ;
//Route::get('/products/create', [App\Http\Controllers\ProductController::class, 'create'])->name('products.create')->middleware('auth') ;
//Route::post('/products', [App\Http\Controllers\ProductController::class, 'store'])->name('products.store')->middleware('auth') ;
//Route::get('/products/edit/{product}', [App\Http\Controllers\ProductController::class, 'edit'])->name('products.edit')->middleware('auth') ;
//Route::get('/products/{product}', [App\Http\Controllers\ProductController::class, 'show'])->name('products.show')->middleware('auth') ;
//Route::post('/products/{product}', [App\Http\Controllers\ProductController::class, 'update'])->name('products.update')->middleware('auth') ;
//Route::delete('/products/{product}',[App\Http\Controllers\ProductController::class,'destroy'])->middleware('auth');



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/cart/list', [App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
Route::get('/cart/{product}', [App\Http\Controllers\CartController::class, 'store'])->name('cart.store');

 
;