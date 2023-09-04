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
Route::get('/profil', [ProfilController::class, 'index'])->name('profil');
Route::get('/riwayat-pendidikan', [PendidikanController::class, 'index'])->name('riwayat-pendidikan');
Route::get('/riwayat-organisasi', [OrganisasiController::class, 'index'])->name('riwayat-organisasi');
Route::get('/riwayat-kerja', [PengalamanController::class, 'index'])->name('riwayat-kerja');
Route::get('/pemograman', [Ms_PemogramanController::class, 'index'])->name('pemograman');
Route::get('/projek', [ProjekController::class, 'index'])->name('projek');


require __DIR__ . '/auth.php';
