<?php

use App\Http\Controllers\Ms_PemogramanController;
use App\Http\Controllers\OrganisasiController;
use App\Http\Controllers\PendidikanController;
use App\Http\Controllers\PengalamanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\ProjekController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// PROFILE
Route::get('/show_profil', [ProfilController::class, 'index'])->name('show_profil');
Route::get('/show-riwayat-pendidikan', [PendidikanController::class, 'index'])->name('show-riwayat-pendidikan');
Route::get('/show-riwayat-organisasi', [OrganisasiController::class, 'index'])->name('show-riwayat-organisasi');
Route::get('/show-riwayat-kerja', [PengalamanController::class, 'index'])->name('show-riwayat-kerja');

Route::get('/show_projek', [ProjekController::class, 'index'])->name('show_projek');
Route::get('/get_projek/{slug}', [ProjekController::class, 'ambil_projek'])->name('get_projek');

Route::get('/show_pemograman', [Ms_PemogramanController::class, 'index'])->name('show_pemograman');


require __DIR__ . '/auth.php';
