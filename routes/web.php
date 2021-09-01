<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BotController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


Route::middleware('guest')->group(function () {

## Login    
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login.attempt');

## Register
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register'])->name('register.post');

});


Route::middleware('auth')->group(function () {

## Logout
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    
## Profile
Route::get('profile', [UserController::class, 'show'])->name('profile');
Route::put('profile/update', [UserController::class, 'update'])->name('profile.update');
Route::delete('profile/delete', [UserController::class, 'destroy'])->name('profile.destroy');

## Bot
Route::get('/', [BotController::class, 'myBots'])->name('dashboard');
Route::post('bot/create', [BotController::class, 'create'])->name('bot.create');
Route::delete('bot/destroy/{bot}', [BotController::class, 'destroy'])->name('bot.destroy');
Route::get('bot/{bot}/index', [BotController::class, 'index'])->name('bot.index');

## Category
Route::get('bot/{bot}/categories', [CategoryController::class, 'categories'])->name('categories');
Route::post('bot/{bot}/categories/add', [CategoryController::class, 'createCategory'])->name('category.create');
Route::delete('category/{category}/destroy', [CategoryController::class, 'destroy'])->name('category.destroy');
Route::get('bot/{bot}/categories/{category}', [CategoryController::class, 'subcategories'])->name('subcategories');
Route::post('bot/{bot}/categories/{category}/add', [CategoryController::class, 'createSubcategory'])->name('subcategory.create');

## Product
Route::get('bot/{bot}/products', [ProductController::class, 'index'])->name('products');
Route::get('bot/{bot}/{category}/products', [ProductController::class, 'select'])->name('products.select');

});
