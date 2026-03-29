<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SymptomController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AIController;

Route::post('/register', [AuthController::class , 'register']);
Route::post('/login', [AuthController::class , 'login']);

Route::get('/doctors', [DoctorController::class , 'index']);
Route::get('/doctors/{id}', [DoctorController::class , 'show']);
Route::get('/doctors/search', [DoctorController::class , 'search']);

Route::middleware('auth:sanctum')->group(function(){

    Route::get('/me', [AuthController::class , 'me']);
    Route::post('/logout', [AuthController::class , 'logout']);

    Route::get('/symptoms', [SymptomController::class , 'index']);
   
    Route::post('/symptoms', [SymptomController::class , 'store']);
   
    Route::get('/symptoms/{id}', [SymptomController::class , 'show']);
    Route::put('/symptoms/{id}', [SymptomController::class , 'update']);
    Route::delete('/symptoms/{id}', [SymptomController::class , 'destroy']);

    Route::get('/appointments', [AppointmentController::class , 'index']);

    
    Route::post('/appointments', [AppointmentController::class , 'store']);
    
    Route::get('/appointments/{id}', [AppointmentController::class , 'show']);
    Route::put('/appointments/{id}', [AppointmentController::class ,  'update']);
    Route::delete('/appointments/{id}', [AppointmentController::class , 'destroy']);

    Route::post('/ai/health-advice', [AIController::class , 'generateAdvice']);
    Route::get('/ai/history', [AIController::class , 'history']);

});