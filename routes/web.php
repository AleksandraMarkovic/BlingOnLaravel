<?php

use \App\Http\Controllers\HomeController;
use \App\Http\Controllers\ProductController;
use \App\Http\Controllers\ContactController;
use \App\Http\Controllers\LoginController;
use \App\Http\Controllers\RegistrationController;
use \App\Http\Controllers\RateProductController;
use \App\Http\Controllers\CartController;
use \App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create')->middleware('isAdmin');
Route::post('/products', [ProductController::class, 'store'])->name('products.store')->middleware('isAdmin');
Route::get('/products/filter', [ProductController::class, 'sortFilter'])->name('sortFilter');
Route::get('/products/{id}', [ProductController::class, 'single'])->name('product');
Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit')->middleware('isAdmin');
Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update')->middleware('isAdmin');
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy')->middleware('isAdmin');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::POST('/sendEmail', [ContactController::class, 'sendEmail'])->name('sendEmail');

Route::get('/loginRegister', [LoginController::class, 'index'])->name('loginRegister');
Route::POST("/login",  [LoginController::class, "login"])->name("login");
Route::get("/logout", [LoginController::class, "logout"])->name("logout");

Route::POST("/register", [RegistrationController::class, "register"])->name("register");

Route::POST('/rate', [RateProductController::class, 'rate'])->name('rate')->middleware('isUser');

Route::get('/cart', [CartController::class, 'index'])->name('cart')->middleware('isUser');
Route::POST('/cart/addToCart', [CartController::class, 'addToCart'])->name('addToCart')->middleware('isUser');
Route::get('/showCart', [CartController::class, 'showCart'])->name('showCart')->middleware('isUser');
Route::get('/cart/showBought', [CartController::class, 'bought'])->name('bought')->middleware('isUser');
Route::post('/cart/buy', [CartController::class, 'buy'])->name('buy')->middleware('isUser');
Route::delete('/cart/delete', [CartController::class, 'delete'])->name('delete')->middleware('isUser');

Route::get('/admin', [AdminController::class, 'index'])->name('admin')->middleware('isAdmin');
Route::get('/date', [AdminController::class, 'admin'])->name('date')->middleware('isAdmin');
