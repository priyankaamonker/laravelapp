<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });
    Route::resource('posts', PostController::class);
    Route::resource('contents', ContentController::class);
    Route::resource('products', ProductController::class);
    Route::resource('users', UserController::class);
    Route::post('/products/{slug}/addtocart', [ProductController::class, 'addToCart'])->name('products.addtocart');
    Route::post('/products/{id}/removeitem', [ProductController::class, 'removeFromCart'])->name('products.removeitem');
    Route::post('/products/{id}/increasequantity', [ProductController::class, 'increaseQuantity'])->name('products.increasequantity');
    Route::post('/products/{id}/decreasequantity', [ProductController::class, 'decreaseQuantity'])->name('products.decreasequantity');
    Route::get('/cart', [ProductController::class, 'cart'])->name('cart.index');
    Route::post('/cart/{productId}/remove', [ProductController::class, 'removeFromCart'])->name('cart.remove');
    Route::get('/checkout', [PaymentController::class, 'checkout'])->name('checkout.index');
    Route::post('/process-payment', [PaymentController::class, 'processPayment'])->name('process.payment');
    Route::get('/payment/success', function () {return view('checkout/payment-success');})->name('payment.success');
    Route::get('/payment/failure', function () {return view('checkout/payment-failure');})->name('payment.failure');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/todos', [App\livewire\Todolist::class, 'index'])->name('index');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);