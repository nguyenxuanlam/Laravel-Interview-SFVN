<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Fruit\CategoryController;
use App\Http\Controllers\Fruit\ItemController;
use App\Http\Controllers\Order\OrderController;
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


// route dashboard
Route::get('/', DashboardController::class)->name('dashboard')->middleware('auth');

//Auth
Route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::get('/register', [AuthController::class, 'register'])->name('register')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/register', [AuthController::class, 'process']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');


//shop
Route::get('/category', [CategoryController::class,'index'])->name('categories')->middleware('auth');
Route::post('/category', [CategoryController::class,'store'])->middleware('auth');
Route::get('/item', [ItemController::class,'index'])->name('item')->middleware('auth');
Route::post('/item', [ItemController::class,'store'])->middleware('auth');

//purchase
Route::resource('/order',OrderController::class)->middleware('auth');
