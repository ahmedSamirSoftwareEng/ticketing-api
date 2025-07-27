<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TicketController;


Route::post('register', [AuthController::class, 'register']);
Route::post('login',    [AuthController::class, 'login']);


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
