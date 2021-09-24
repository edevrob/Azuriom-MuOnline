<?php

use Azuriom\Plugin\MuOnline\Controllers\Admin\AdminController;
use Azuriom\Plugin\MuOnline\Controllers\Admin\MuOnlineCharacterController;
use Azuriom\Plugin\MuOnline\Controllers\Admin\SettingController;
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

Route::get('/', [AdminController::class, 'index'])->name('users');

Route::get('/info', [AdminController::class, 'info'])->name('info');

Route::get('/characters', [MuOnlineCharacterController::class, 'charactersList'])->name('characters');
Route::get('/characters/edit/{id}', [MuOnlineCharacterController::class, 'charactersEdit'])->name('charactersEdit');
Route::post('/characters/edit/{id}/update', [MuOnlineCharacterController::class, 'charactersUpdate'])->name('charactersUpdate');


Route::get('/settings', [SettingController::class, 'index'])->name('settings');
Route::post('/settings', [SettingController::class, 'update'])->name('settings_update');
