<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\MovementController;
use App\Http\Controllers\StockController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');


Route::resource('products', ProductController::class);


Route::resource('suppliers', SupplierController::class);


Route::prefix('stock')->group(function () {
    Route::get('/', [StockController::class, 'index'])->name('stock.index');
    Route::get('/in/{product}', [StockController::class, 'createIn'])->name('stock.in.create');
    Route::post('/in/{product}', [StockController::class, 'storeIn'])->name('stock.in.store');
    Route::get('/out/{product}', [StockController::class, 'createOut'])->name('stock.out.create');
    Route::post('/out/{product}', [StockController::class, 'storeOut'])->name('stock.out.store');
});


Route::get('/movements', [MovementController::class, 'index'])->name('movements.index');
