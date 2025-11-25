<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DashboardController;

Route::get('/', function () {
    return view('dashboard');
});

// API routes for Google Sheets data
Route::prefix('api/dashboard')->group(function () {
    Route::get('/data', [DashboardController::class, 'getData']);
    Route::get('/purchase-orders', [DashboardController::class, 'getPurchaseOrders']);
    Route::get('/vendors', [DashboardController::class, 'getVendors']);
    Route::post('/cache/clear', [DashboardController::class, 'clearCache']);
    Route::get('/test-connection', [DashboardController::class, 'testConnection']);
});
