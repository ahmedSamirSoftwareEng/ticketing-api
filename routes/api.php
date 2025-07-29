<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\Admin\TicketController as AdminTicketController;
use App\Http\Middleware\IsAdmin;

// Auth
Route::post('register', [AuthController::class, 'register']);
Route::post('login',    [AuthController::class, 'login']);


// Admin
Route::middleware(['auth:sanctum' , IsAdmin::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('tickets', [AdminTicketController::class, 'index']);
    Route::get('tickets/{ticket}', [AdminTicketController::class, 'show']);
    Route::patch('tickets/{ticket}/status', [AdminTicketController::class, 'updateStatus']);
    Route::delete('tickets/{ticket}', [AdminTicketController::class, 'destroy']);
});


// User
Route::middleware('auth:sanctum')->group(function () {
    // Logout
    Route::post('logout', [AuthController::class, 'logout']);

    // Ticket
    Route::apiResource('tickets', TicketController::class)
        ->except(['update']);
    Route::patch(
        'tickets/{ticket}/status',
        [TicketController::class, 'updateStatus']
    );
});



