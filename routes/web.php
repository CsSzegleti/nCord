<?php

use App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [Controllers\HomeController::class, 'index'])->name('home');
Route::get('/torrent/{torrent}', [Controllers\TorrentController::class, 'show'])->name('torrent.details');

Route::middleware(['guest'])->group(function ()
{
    Route::get('/sign-up', [Controllers\Auth\RegisterController::class, 'create'])->name('auth.register');
    Route::post('/sign-up', [Controllers\Auth\RegisterController::class, 'store']);
    Route::get('/sing-in', [Controllers\Auth\SessionController::class, 'create'])->name('auth.login');
    Route::post('/sing-in', [Controllers\Auth\SessionController::class, 'store']);
});

Route::middleware(['auth'])->group(function ()
{
    Route::post('/sign-out', [Controllers\Auth\SessionController::class, 'destroy'])->name('auth.logout');
    Route::get('/upload', [Controllers\TorrentController::class, 'create'])->name('torrent.upload');
    Route::post('/upload', [Controllers\TorrentController::class, 'store']);
    Route::get('/torrent/{torrent}/edit', [Controllers\TorrentController::class, 'edit'])->name('torrent.edit');
    Route::post('/torrent/{torrent}/edit', [Controllers\TorrentController::class, 'update']);
    Route::post('/torrent/{torrent}/rate', [Controllers\TorrentController::class, 'rate'])->name('torrent.rate');
    Route::post('/torrent/{torrent}/image', [Controllers\TorrentController::class, 'uploadImage'])->name('torrent.image');
});