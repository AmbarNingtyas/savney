<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AutoCutController;
use App\Http\Controllers\InvestmentController;

// Autentikasi
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    });
});


// Proteksi dengan Sanctum
Route::middleware('auth:sanctum')->group(function () {
    // Transactions
    Route::post('/transactions', [TransactionController::class, 'store']);
    Route::get('/transactions', [TransactionController::class, 'index']);
    // Route::put('/transactions/{id}', [TransactionController::class, 'update']);
    // Route::delete('/transactions/{id}', [TransactionController::class, 'destroy']);
    
    // Auto Cut
    Route::post('/auto-cuts', [AutoCutController::class, 'store']);

    // Investment
    Route::post('/investment/predict', [InvestmentController::class, 'predict']);
});