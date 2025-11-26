<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

use App\Http\Controllers\PostController;

// === ketika menggunakan postController.php ===
// Admin bisa CRUD
// Route::middleware(['auth', 'role:admin'])->group(function () {
//     Route::resource('posts', PostController::class)->except(['index', 'show']);
// });

//  User biasa hanya bisa lihat
// Route::middleware(['auth'])->group(function () {
//     Route::get('posts', [PostController::class, 'index'])->name('posts.index');
//     Route::get('posts/{post}', [PostController::class, 'show'])->name('posts.show');
// });

// === ketika menggunakan mahasiswaController.php ===
// Admin bisa CRUD Mahasiswa
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('mahasiswa', MahasiswaController::class)->except(['index']);
});

// User biasa hanya bisa lihat daftar Mahasiswa
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::resource('mahasiswa', MahasiswaController::class);