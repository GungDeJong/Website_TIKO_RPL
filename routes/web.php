<?php

use App\Http\Controllers\ArtisController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PengembalianDanaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TiketController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Profiler\Profile;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['register' => true]);

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/berita', [BeritaController::class, 'index'])->name('posts.index');
Route::get('/berita/{post_slug}', [BeritaController::class, 'show'])->name('posts.show');
Route::get('/event', [EventController::class, 'index'])->name('events.index');
Route::get('/event/{post_slug}', [EventController::class, 'show'])->name('events.show');
Route::get('/artis', [ArtisController::class, 'index'])->name('artis.index');
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::get('/transaksi/{uuid}/pilih-tiket', [TransaksiController::class, 'pilih_tiket'])->name('transaksi.pilih-tiket');

Route::middleware('auth')->group(function () {
    Route::get('transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::get('transaksi/{uuid}', [TransaksiController::class, 'show'])->name('transaksi.show');
    Route::post('/transaksi/checkout', [TransaksiController::class, 'checkout'])->name('transaksi.checkout');

    // tiket
    Route::get('tiket', [TiketController::class, 'index'])->name('tiket.index');
    // pengembalian-dana
    Route::get('pengembalian-dana', [PengembalianDanaController::class, 'index'])->name('pengembalian-dana.index');
    Route::get('pengembalian-dana/create', [PengembalianDanaController::class, 'create'])->name('pengembalian-dana.create');
    Route::post('pengembalian-dana/create', [PengembalianDanaController::class, 'store'])->name('pengembalian-dana.store');
});
