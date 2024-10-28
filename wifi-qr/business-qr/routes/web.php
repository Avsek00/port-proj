<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\QRController;

Route::get('/', [QRController::class, 'showForm']);
Route::post('/upload', [QRController::class, 'upload'])->name('upload');
