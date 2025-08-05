<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UmkmController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('pages.home');
})->name('home');

Route::get('/themes/nature', function () {
    return view('themes.nature');
});

Route::get('/themes/goverment', function () {
    return view('themes.goverment');
});

Route::get('/themes/modern', function () {
    return view('themes.modern');
});

Route::get('/themes/umkm', function () {
    return view('themes.umkm');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('umkm', UmkmController::class);

require __DIR__.'/auth.php';
