<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PropertyController;
use App\Http\Controllers\API\AgentController;
use App\Http\Controllers\API\InquiryController;
use App\Http\Controllers\API\WhatsAppController;

// ========== PUBLIC ROUTES ==========

// Auth
Route::post('/login', [AuthController::class, 'login']);

// Properties (Public)
Route::get('/properties', [PropertyController::class, 'index']);
Route::get('/properties/featured', [PropertyController::class, 'featured']);
Route::get('/properties/{id}', [PropertyController::class, 'show']);

// ✅ Agents (Public)
Route::get('/agents', [AgentController::class, 'index']);
Route::get('/agents/{id}', [AgentController::class, 'show']);

// Inquiries (Public - Create)
Route::post('/inquiries', [InquiryController::class, 'store']);
Route::post('/send-whatsapp', [WhatsAppController::class, 'send']);

// ========== PROTECTED ROUTES (Admin) ==========
Route::middleware('auth:sanctum')->group(function () {
    // Auth
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);

    // Properties (Admin)
    Route::post('/properties', [PropertyController::class, 'store']);
    Route::put('/properties/{id}', [PropertyController::class, 'update']);
    Route::delete('/properties/{id}', [PropertyController::class, 'destroy']);

    // ✅ Agents (Admin)
    Route::post('/agents', [AgentController::class, 'store']);
    Route::put('/agents/{id}', [AgentController::class, 'update']);
    Route::delete('/agents/{id}', [AgentController::class, 'destroy']);

    // Inquiries (Admin)
    Route::get('/inquiries', [InquiryController::class, 'index']);
    Route::get('/inquiries/{id}', [InquiryController::class, 'show']);
    Route::put('/inquiries/{id}/read', [InquiryController::class, 'markAsRead']);
    Route::delete('/inquiries/{id}', [InquiryController::class, 'destroy']);
});