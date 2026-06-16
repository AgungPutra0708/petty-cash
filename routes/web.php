<?php

use App\Http\Controllers\BilyetController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MasterBarangController;
use App\Http\Controllers\HistoryStockController;
use App\Http\Controllers\PettyCashController;
use App\Http\Controllers\UserController;
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
    
    Route::get('/master-barang', [MasterBarangController::class, 'index'])->name('master-barang.index');
    Route::get('/master-barang/get-data', [MasterBarangController::class, 'getDataBarang'])->name('master-barang.data');
    Route::get('/master-barang/create', [MasterBarangController::class, 'create'])->name('master-barang.create');
    Route::post('/master-barang', [MasterBarangController::class, 'store'])->name('master-barang.store');
    Route::get('/master-barang/{barang}/edit', [MasterBarangController::class, 'edit'])->name('master-barang.edit');
    Route::put('/master-barang/{barang}', [MasterBarangController::class, 'update'])->name('master-barang.update');
    Route::delete('/master-barang/{barang}', [MasterBarangController::class, 'destroy'])->name('master-barang.destroy');
    Route::get('/master-barang/get-last-number/{barang}', [MasterBarangController::class, 'getLastNumber']);

    // History Stock Routes
    Route::get('/history-stock', [HistoryStockController::class, 'index'])->name('history-stock.index');
    Route::get('/history-stock/get-data', [HistoryStockController::class, 'getDataHistoryStock'])->name('history-stock.data');
    Route::get('/history-stock/report', [HistoryStockController::class, 'report'])->name('history-stock.report');
    Route::get('/history-stock/report/data', [HistoryStockController::class, 'getStockSummary'])->name('history-stock.report.data');
    Route::get('history-stock/export-excel', [HistoryStockController::class, 'exportExcel'])->name('history-stock.export-excel');
    Route::get('history-stock/export-pdf', [HistoryStockController::class, 'exportPdf'])->name('history-stock.export-pdf');

    // Pemasukan Barang Routes
    Route::get('/pemasukan', [HistoryStockController::class, 'indexPemasukan'])->name('pemasukan.index');
    Route::get('/pemasukan/get-data', [HistoryStockController::class, 'getDataPemasukan'])->name('pemasukan.data');
    Route::get('/pemasukan/create', [HistoryStockController::class, 'createPemasukan'])->name('pemasukan.create');
    Route::post('/pemasukan', [HistoryStockController::class, 'storePemasukan'])->name('pemasukan.store');
    Route::get('/pemasukan/{historyStock}/edit', [HistoryStockController::class, 'editPemasukan'])->name('pemasukan.edit');
    Route::put('/pemasukan/{historyStock}', [HistoryStockController::class, 'updatePemasukan'])->name('pemasukan.update');
    Route::delete('/pemasukan/{historyStock}', [HistoryStockController::class, 'destroy'])->name('pemasukan.destroy');
    Route::post('/pemasukan/{historyStock}/submit-approval', [HistoryStockController::class, 'submitApproval'])->name('pemasukan.submit-approval');
    Route::post('/pemasukan/{historyStock}/approve', [HistoryStockController::class, 'approve'])->name('pemasukan.approve');
    Route::post('/pemasukan/{historyStock}/reject', [HistoryStockController::class, 'reject'])->name('pemasukan.reject');

    // Pengeluaran Barang Routes
    Route::get('/pengeluaran', [HistoryStockController::class, 'indexPengeluaran'])->name('pengeluaran.index');
    Route::get('/pengeluaran/get-data', [HistoryStockController::class, 'getDataPengeluaran'])->name('pengeluaran.data');
    Route::get('/pengeluaran/create', [HistoryStockController::class, 'createPengeluaran'])->name('pengeluaran.create');
    Route::post('/pengeluaran', [HistoryStockController::class, 'storePengeluaran'])->name('pengeluaran.store');
    Route::get('/pengeluaran/{historyStock}/edit', [HistoryStockController::class, 'editPengeluaran'])->name('pengeluaran.edit');
    Route::put('/pengeluaran/{historyStock}', [HistoryStockController::class, 'updatePengeluaran'])->name('pengeluaran.update');
    Route::delete('/pengeluaran/{historyStock}', [HistoryStockController::class, 'destroy'])->name('pengeluaran.destroy');
    Route::post('/pengeluaran/{historyStock}/submit-approval', [HistoryStockController::class, 'submitApproval'])->name('pengeluaran.submit-approval');
    Route::post('/pengeluaran/{historyStock}/approve', [HistoryStockController::class, 'approve'])->name('pengeluaran.approve');
    Route::post('/pengeluaran/{historyStock}/reject', [HistoryStockController::class, 'reject'])->name('pengeluaran.reject');

    // User Management Routes (Admin Only)
    Route::middleware(['auth'])->group(function () {
        Route::get('/user', [UserController::class, 'index'])->name('user.index');
        Route::get('/user/get-data', [UserController::class, 'getDataUser'])->name('user.data');
        Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
        Route::post('/user', [UserController::class, 'store'])->name('user.store');
        Route::get('/user/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::put('/user/{user}', [UserController::class, 'update'])->name('user.update');
        Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('user.destroy');
    });

    // Petty Cash Routes
    Route::get('/petty-cash', [PettyCashController::class, 'index'])->name('petty-cash.index');
    Route::get('/petty-cash/get-data', [PettyCashController::class, 'getDataPettyCash'])->name('petty-cash.data');
    Route::get('/petty-cash/create', [PettyCashController::class, 'create'])->name('petty-cash.create');
    Route::post('/petty-cash', [PettyCashController::class, 'store'])->name('petty-cash.store');
    Route::get('/petty-cash/report', [PettyCashController::class, 'report'])->name('petty-cash.report');
    Route::get('/petty-cash/report/data', [PettyCashController::class, 'reportData'])->name('petty-cash.report.data');
    Route::get('/petty-cash/report/pdf/{id}', [PettyCashController::class, 'exportPdfSingle'])->name('petty-cash.report.pdf.single');
    Route::get('/petty-cash/report/pdf', [PettyCashController::class, 'exportPdfRecap'])->name('petty-cash.report.pdf');
    Route::get('/petty-cash/report/excel', [PettyCashController::class, 'exportExcel'])->name('petty-cash.report.excel');
    Route::get('/petty-cash/{pettyCash}', [PettyCashController::class, 'show'])->name('petty-cash.show');
    Route::get('/petty-cash/{pettyCash}/edit', [PettyCashController::class, 'edit'])->name('petty-cash.edit');
    Route::put('/petty-cash/{pettyCash}', [PettyCashController::class, 'update'])->name('petty-cash.update');
    Route::delete('/petty-cash/{pettyCash}', [PettyCashController::class, 'destroy'])->name('petty-cash.destroy');
    Route::post('/petty-cash/{pettyCash}/approve', [PettyCashController::class, 'approve'])->name('petty-cash.approve');
    
    // Petty Cash Detail Routes
    Route::post('/petty-cash/{pettyCash}/detail', [PettyCashController::class, 'storeDetail'])->name('petty-cash-detail.store');
    Route::get('/petty-cash-detail/{detail}/edit', [PettyCashController::class, 'editDetail'])->name('petty-cash-detail.edit');
    Route::put('/petty-cash-detail/{detail}', [PettyCashController::class, 'updateDetail'])->name('petty-cash-detail.update');
    Route::delete('/petty-cash-detail/{detail}', [PettyCashController::class, 'destroyDetail'])->name('petty-cash-detail.destroy');
});