<?php

use App\Http\Controllers\BilyetController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard.index');
});


Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login/authenticate', [LoginController::class, 'authenticate'])->name('login.authenticate');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Protected routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::get('/bilyet', [BilyetController::class, 'index'])->name('bilyet.index');
    Route::get('/bilyet/get-data', [BilyetController::class, 'getDataBilyet'])->name('bilyet.data');
    Route::get('/bilyet/create', [BilyetController::class, 'create'])->name('bilyet.create');
    Route::post('/bilyet', [BilyetController::class, 'store'])->name('bilyet.store');
    Route::get('/bilyet/{bilyet}/edit', [BilyetController::class, 'edit'])->name('bilyet.edit');
    Route::put('/bilyet/{bilyet}', [BilyetController::class, 'update'])->name('bilyet.update');
    Route::delete('/bilyet/{bilyet}', [BilyetController::class, 'destroy'])->name('bilyet.destroy');
    Route::get('/bilyet/get-last-number/{customer}', [BilyetController::class, 'getLastNumber']);
    
    Route::get('/customer', [CustomerController::class, 'index'])->name('customer.index');
    Route::get('/customer/get-data', [CustomerController::class, 'getDataCustomer'])->name('customer.data');
    Route::get('/customer/create', [CustomerController::class, 'create'])->name('customer.create');
    Route::post('/customer', [CustomerController::class, 'store'])->name('customer.store');
    Route::get('/customer/{customer}/edit', [CustomerController::class, 'edit'])->name('customer.edit');
    Route::put('/customer/{customer}', [CustomerController::class, 'update'])->name('customer.update');
    Route::delete('/customer/{customer}', [CustomerController::class, 'destroy'])->name('customer.destroy');
    Route::get('/customer/get-last-number/{customer}', [CustomerController::class, 'getLastNumber']);
    
    Route::get('/stock', [CustomerController::class, 'index'])->name('stock.index');
    Route::get('/stock/get-data', [CustomerController::class, 'getDataCustomer'])->name('stock.data');
    Route::get('/stock/create', [CustomerController::class, 'create'])->name('stock.create');
    Route::post('/stock', [CustomerController::class, 'store'])->name('stock.store');
    Route::get('/stock/{stock}/edit', [CustomerController::class, 'edit'])->name('stock.edit');
    Route::put('/stock/{stock}', [CustomerController::class, 'update'])->name('stock.update');
    Route::delete('/stock/{stock}', [CustomerController::class, 'destroy'])->name('stock.destroy');
    Route::get('/stock/get-last-number/{stock}', [CustomerController::class, 'getLastNumber']);
});