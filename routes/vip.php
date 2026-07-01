<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VipDarshanController;

Route::get('/', [VipDarshanController::class, 'landing'])->name('landing');
Route::get('/status', [VipDarshanController::class, 'statusForm'])->name('status');
Route::post('/status', [VipDarshanController::class, 'statusSearch'])->name('status.search');
Route::get('/register', [VipDarshanController::class, 'create'])->name('create');
Route::post('/register', [VipDarshanController::class, 'store'])->name('store');
Route::get('/success/{id}', [VipDarshanController::class, 'success'])->name('success');
Route::get('/ticket/{id}/preview', [VipDarshanController::class, 'previewTicket'])->name('ticket.preview');
Route::get('/ticket/{id}/download', [VipDarshanController::class, 'downloadTicket'])->name('ticket.download');
