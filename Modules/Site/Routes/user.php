<?php

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

use Illuminate\Support\Facades\Route;
use Modules\Site\Http\Controllers\UserController;

Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('site.users.index')->middleware('can:user-list');
    Route::get('/create', [UserController::class, 'create'])->name('site.users.create')->middleware('can:user-create');
    Route::post('/store', [UserController::class, 'store'])->name('site.users.store')->middleware('can:user-create');
    Route::post('/batch-destroy', [UserController::class, 'batchDestroy'])->name('site.users.batch-destroy')->middleware('can:user-delete');
    Route::get('/show/{id}', [UserController::class, 'show'])->name('site.users.show')->middleware('can:user-view');
    Route::get('/{user}/edit', [UserController::class, 'edit'])->name('site.users.edit')->middleware('can:user-edit');
    Route::put('/{id}/update', [UserController::class, 'update'])->name('site.users.update')->middleware('can:user-edit');
    Route::delete('/{id}/delete', [UserController::class, 'destroy'])->name('site.users.destroy')->middleware('can:user-delete');
    Route::get('/profile', [UserController::class, 'profile'])->name('site.users.profile');
    Route::get('/profile-edit', [UserController::class, 'editProfile'])->name('site.users.edit_profile');
    Route::put('/profile-update', [UserController::class, 'updateProfile'])->name('site.users.update_profile');

    // datatables
    Route::get('/users_data', [UserController::class, 'igetUsersDatandex'])->name('site.users.getUsersData')->middleware('can:user-list');
    Route::get('/roles/{id}', [UserController::class, 'getRoles'])->name('site.users.getRoles')->middleware('can:user-list');

    ### LOGIN AS
    Route::get('logged-as/login/{id}', [UserController::class, 'login'])->name('site.users.logged-as.login')->middleware('can:logged-as');
    Route::get('logged-as/logout', [UserController::class, 'logout'])->name('site.users.logged-as.logout');
});