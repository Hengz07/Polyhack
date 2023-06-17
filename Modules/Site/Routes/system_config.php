<?php

use Illuminate\Support\Facades\Route;
use Modules\Site\Http\Controllers\SystemConfigController;

/*
|--------------------------------------------------------------------------
| System Config Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */
## system config
Route::get('system-configs', [SystemConfigController::class, 'index'])->name('site.system-configs.index')->middleware('can:system-config');
Route::post('system-configs/store', [SystemConfigController::class, 'store'])->name('site.system-configs.store')->middleware('can:system-config');
