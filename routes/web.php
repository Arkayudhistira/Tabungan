<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AjuanController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::put('/ajuan/{id}/setujui', [AjuanController::class, 'setujui'])->name('ajuan.setujui');


Route::post('/ajuan', [AjuanController::class, 'store'])->name('ajuan.store');
Route::put('/ajuan/{id}/setujui', [AjuanController::class, 'setujui'])->name('ajuan.setujui');


Route::middleware(['auth'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::put('/ajuan/{id}/tolak', [AjuanController::class, 'tolak'])->name('ajuan.tolak');
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('admin/riwayat', [AdminController::class, 'riwayat'])->name('admin.riwayat');
});





require __DIR__.'/auth.php';
