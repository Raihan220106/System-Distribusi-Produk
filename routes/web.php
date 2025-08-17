<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthManualController;
use App\Http\Controllers\DistributionController;
use App\Http\Controllers\DistributionProductController;

Route::get('/', function () {
    return redirect()->route('distributions.index');
});

// Routes login (public)
Route::get('/login', [AuthManualController::class,'index'])->name('login');
Route::post('/login', [AuthManualController::class,'loginProses'])->name('loginProses');
Route::post('/logout', [AuthManualController::class,'logout'])->name('logout');

// Routes yang hanya bisa diakses setelah login
Route::middleware('auth')->group(function () {
    Route::resource('distributions', DistributionController::class);
    Route::get('/distributions/{distribution}/details', [DistributionController::class, 'details'])->name('distributions.details');

    Route::get('/distribution-products', [DistributionProductController::class, 'index']);
    Route::post('/distribution-products', [DistributionProductController::class, 'store']);
    Route::delete('/distribution-products/{id}', [DistributionProductController::class, 'destroy']);
    Route::get('/distributions/{id}', [DistributionController::class, 'show'])->name('distributions.show');

});
