<?php

use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\CaseWebController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.perform');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [CaseWebController::class, 'dashboard'])->name('dashboard');
    Route::get('/cases', [CaseWebController::class, 'index'])->name('cases.index');
    Route::get('/cases/create', [CaseWebController::class, 'create'])->name('cases.create');
    Route::post('/cases', [CaseWebController::class, 'store'])->name('cases.store');
    Route::get('/cases/{case}', [CaseWebController::class, 'show'])->name('cases.show');
    Route::get('/cases/{case}/edit', [CaseWebController::class, 'edit'])->name('cases.edit');
    Route::put('/cases/{case}', [CaseWebController::class, 'update'])->name('cases.update');
    Route::delete('/cases/{case}', [CaseWebController::class, 'destroy'])->name('cases.destroy');
});
