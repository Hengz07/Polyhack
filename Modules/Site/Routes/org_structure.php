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
use Modules\Site\Http\Controllers\ManageAdminController;
use Modules\Site\Http\Controllers\OrgStructureController;

Route::prefix('org-structure', [
    'as' => 'site',
])->group(function() {
    Route::get('/', [OrgStructureController::class, 'index'])->name('site.org-structure.index')->middleware('can:org-structure-list');
    Route::get('/create-sub/{level}/{id}', [OrgStructureController::class, 'createSub'])->name('site.org-structure.create-sub');
    Route::put('/create-sub/{level}/{id}', [OrgStructureController::class, 'updateSub'])->name('site.org-structure.update-sub');
    Route::post('/create-store-sub/{level}/{id}', [OrgStructureController::class, 'storeSub'])->name('site.org-structure.store-sub');
    Route::delete('/destroy-sub/{level}/{id}', [OrgStructureController::class, 'destroySub'])->name('site.org-structure.destroy-sub');

    ## manage admin
    Route::get('/manage-admin/{level}/{id}', [ManageAdminController::class, 'index'])->name('site.org-structure.manage-admin.index');
    Route::post('/manage-admin/store/{level}/{id}', [ManageAdminController::class, 'store'])->name('site.org-structure.manage-admin.store');

    ### Faculties
    // Route::post('/ptjs/store-admin/{faculty}', [PtjController::class, 'storeAdmin'])->name('ptjs.store-admin');
    // Route::delete('/ptjs/destroy-assignment/{id}', [PtjController::class, 'destroyAssignment'])->name('ptjs.destroy-assignment');
    // Route::get('/ptjs/fetch', [PtjController::class, 'fetch'])->name('ptjs.fetch')->middleware('can:org-structure-fetch');
    // Route::post('/ptjs/update-active', [PtjController::class, 'updateActive'])->name('ptjs.update-active')->middleware('can:org-structure-edit');
    // Route::resource('ptjs', \Modules\System\OrgStructure\PtjController::class);

    // ### Departments
    // Route::post('/departments/store-admin/{department}', [DepartmentController::class, 'storeAdmin'])->name('departments.store-admin');
    // Route::delete('/departments/destroy-assignment/{id}', [DepartmentController::class, 'destroyAssignment'])->name('departments.destroy-assignment');
    // Route::get('/departments/fetch', [DepartmentController::class, 'fetch'])->name('departments.fetch');
    // Route::post('/departments/update-active', [DepartmentController::class, 'storeAdmin'])->name('departments.update-active');
    // Route::resource('/departments', \Modules\System\OrgStructure\DepartmentController::class);

    ### Divisions
    // Route::post('/divisions/update-active', 'OrgStructure\DivisionController@updateActive')->name('divisions.update-active');
    // Route::resource('/divisions', 'OrgStructure\DivisionController');

    // ### Sections
    // Route::post('/sections/update-active', 'OrgStructure\SectionController@updateActive')->name('sections.update-active');
    // Route::resource('/sections', 'OrgStructure\SectionController');

    // ### Units
    // Route::post('/units/update-active', 'OrgStructure\UnitController@updateActive')->name('units.update-active');
    // Route::resource('/units', 'OrgStructure\UnitController');
});
