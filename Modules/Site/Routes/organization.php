<?php

use Illuminate\Support\Facades\Route;
use Modules\Site\Http\Controllers\OrganizationController;
use Modules\Site\Http\Controllers\RoleController;

/*
|--------------------------------------------------------------------------
| Organization Routes /site/organizations
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::resource('organizations', 'OrganizationController', ['as' => 'site']);

Route::post('site/organizations/save-nested-categories', [OrganizationController::class, 'saveNestedCategories'])->name('site.organizations.save-nested-categories');