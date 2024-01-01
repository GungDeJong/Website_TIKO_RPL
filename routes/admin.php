<?php

use App\Http\Controllers\Admin\ArtisController;
use App\Http\Controllers\Admin\ArtisKonserController;
use App\Http\Controllers\Admin\ChangePasswordController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KonserArtisController;
use App\Http\Controllers\Admin\KonserController;
use App\Http\Controllers\Admin\MetodePembayaranController;
use App\Http\Controllers\Admin\PengambilanDanaController;
use App\Http\Controllers\Admin\PengembalianDanaController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\PostCategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\PostTagController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SocmedController;
use App\Http\Controllers\Admin\TiketController;
use App\Http\Controllers\Admin\TiketKonserController;
use App\Http\Controllers\Admin\TransaksiController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::get('/change-password', [ChangePasswordController::class, 'index'])->name('change-password.index');
Route::post('/change-password', [ChangePasswordController::class, 'update'])->name('change-password.update');

// users
Route::get('users/data', [UserController::class, 'data'])->name('users.data');
Route::resource('users', UserController::class)->except('show');
Route::post('users/change-status', [UserController::class, 'changeStatus'])->name('users.change-status');

// post category
Route::get('post-categories/data', [PostCategoryController::class, 'data'])->name('post-categories.data');
Route::resource('post-categories', PostCategoryController::class)->except('create', 'show', 'edit', 'update');

// post tag
Route::get('post-tags/data', [PostTagController::class, 'data'])->name('post-tags.data');
Route::resource('post-tags', PostTagController::class)->except('create', 'show', 'edit', 'update');

// roles
Route::post('roles/get', [RoleController::class, 'get'])->name('roles.get');

// posts
Route::get('posts/data', [PostController::class, 'data'])->name('posts.data');
Route::resource('posts', PostController::class);
Route::post('posts/change-status', [PostController::class, 'changeStatus'])->name('posts.change-status');


// filemanager
Route::group(['prefix' => 'filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

// setting
Route::get('setting', [SettingController::class, 'index'])->name('settings.index');
Route::post('setting', [SettingController::class, 'update'])->name('settings.update');

// metode pembayaran
Route::get('metode-pembayaran/data', [MetodePembayaranController::class, 'data'])->name('metode-pembayaran.data');
Route::resource('metode-pembayaran', MetodePembayaranController::class)->except('create', 'show', 'edit', 'update');

// artis
Route::get('artis/data', [ArtisController::class, 'data'])->name('artis.data');
Route::resource('artis', ArtisController::class)->except('create', 'show', 'edit', 'update');

// konser
Route::get('konser/data', [KonserController::class, 'data'])->name('konser.data');
Route::resource('konser', KonserController::class);

// artis-konser
Route::resource('artis-konser', ArtisKonserController::class);

// tiket-konser
Route::resource('tiket-konser', TiketKonserController::class);

// transaksi
Route::resource('transaksi', TransaksiController::class);

// tiket
Route::resource('tiket', TiketController::class);
// tiket
Route::resource('pengembalian-dana', PengembalianDanaController::class);
