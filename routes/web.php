<?php

use Azuriom\Plugin\MuOnline\Controllers\MuOnlineAccountController;
use Azuriom\Plugin\MuOnline\Controllers\MuOnlineHomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your plugin. These
| routes are loaded by the RouteServiceProvider of your plugin within
| a group which contains the "web" middleware group and your plugin name
| as prefix. Now create something great!
|
*/

Route::get('/', [MuOnlineHomeController::class, 'index']);

Route::prefix('accounts')->name('accounts.')->middleware('auth')->group(function () {
    Route::get('/', [MuOnlineHomeController::class, 'index'])->name('index');
    Route::post('/', [MuOnlineAccountController::class, 'store'])->name('store');
    Route::post('/link', [MuOnlineAccountController::class, 'link'])->name('link');
    Route::get('/characters', [MuOnlineAccountController::class, 'characters'])->name('characters');
    Route::get('/characters/reset/{id}', [MuOnlineAccountController::class, 'charactersReset'])->name('charactersReset');
    Route::get('/{account}', [MuOnlineAccountController::class, 'edit'])->name('edit');
    Route::post('/{account}/change-password', [MuOnlineAccountController::class, 'update'])->name('change-password');
});
