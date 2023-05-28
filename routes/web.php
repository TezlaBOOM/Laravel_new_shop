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
Auth::routes(['verify' => true]);

Route::middleware(['auth','verified'])->group(function(){
    Route::get('products/{product}/download',[App\Http\Controllers\ProductController::class,'downloadImage'])->name('products.downloadImage')->middleware(['can:isAdmin']);

    Route::middleware(['can:isAdmin'])->group(function(){
        Route::resource('products', App\Http\Controllers\ProductController::class);
       // Route::resource('users', App\Http\Controllers\UserController::class)->only([
       //     'index','edit', 'update', 'destroy'
       // ]);
        Route::get('/users/list', [App\Http\Controllers\UserController::class, 'index'])->name('users.index')->middleware('can:isAdmin') ;
        Route::get('/users/edit/{user}', [App\Http\Controllers\UserController::class, 'edit'])->name('users.edit')->middleware('can:isAdmin') ;
        Route::put('/users/{user}', [App\Http\Controllers\UserController::class, 'update'])->name('users.update')->middleware('can:isAdmin') ;
        Route::delete('/users/list/{id}',[App\Http\Controllers\UserController::class,'destroy'])->middleware('can:isAdmin');
    });
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/{product}', [App\Http\Controllers\CartController::class, 'store'])->name('cart.store');
    Route::delete('/cart/{product}',[App\Http\Controllers\CartController::class,'destroy'])->name('cart.destroy');

    Route::get('/orders', [App\Http\Controllers\OrderController::class, 'index'])->name('orders.index');
    Route::post('/orders', [App\Http\Controllers\OrderController::class, 'store'])->name('orders.store');

    


    Route::get('access', [App\Http\Controllers\OrderController::class, 'successStripe'])->name('Succes.Stripe');
    Route::get('success', [App\Http\Controllers\OrderController::class, 'success']);
    Route::get('error', [App\Http\Controllers\OrderController::class, 'error']);
    Route::post('/payment/status', [App\Http\Controllers\PaymentController::class, 'status']);

   
});






 
;