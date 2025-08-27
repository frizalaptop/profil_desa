<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UmkmController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
});

Route::get('/home', function () {
    return view('pages.home');
})->name('home');

Route::get('/service', function () {
    return view('pages.service');
});

Route::post('/services/upload', [ServiceController::class, 'upload'])
    ->middleware(['auth', 'verified'])
    ->name('services.upload');

Route::get('/umkm/{umkm}/preview', [UmkmController::class, 'preview'])
    ->middleware(['auth', 'verified'])
    ->name('umkm.preview');
Route::put('/umkm/{umkm}/verify', [UmkmController::class, 'verify'])
    ->middleware(['auth', 'verified'])
    ->name('umkm.verify');

Route::middleware(['auth', 'verified'])
    ->group(function() {
        Route::resource('umkm', UmkmController::class)
            ->withoutMiddlewareFor(['index', 'show'], ['auth', 'verified']);
    });


Route::controller( UserController::class)->group(function () {
    Route::put('users/{user}/promote', 'promote')
        ->name('users.promote');
    Route::put('users/{user}/demote', 'demote')
        ->name('users.demote'); 
})->middleware(['auth', 'verified']);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Route::patch('/profile', [DashboardController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [DashboardController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';


// google-site-verification=UoCZtNOLdM3HgLN_-EUHe6bMpNfHoUQ9fbfZ2ewzfps