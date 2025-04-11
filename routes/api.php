<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AutoCutController;
use App\Http\Controllers\InvestmentController;
use App\Http\Controllers\DashboardController;


// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    
    // Transactions
    Route::Resource('transactions', TransactionController::class);
    
    // Auto Cut
    Route::Resource('autoCuts', AutoCutController::class);
    
    // Investment
    Route::prefix('investments')->group(function () {
        Route::post('predict', [InvestmentController::class, 'predict']);
        Route::post('/', [InvestmentController::class, 'store']);
    });
    
    // Dashboard summary
    Route::get('/dashboard', [DashboardController::class, 'summary']);
});