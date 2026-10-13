<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CaseApiController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/cases', [CaseApiController::class, 'index']);
    Route::post('/cases', [CaseApiController::class, 'store'])->middleware('can:create,App\Models\MedicalCase');
    Route::get('/cases/{id}', [CaseApiController::class, 'show']);
    Route::put('/cases/{id}', [CaseApiController::class, 'update']);
    Route::delete('/cases/{id}', [CaseApiController::class, 'destroy']);
});
