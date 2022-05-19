<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Subfission\Cas\Facades\Cas;

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
Route::get('/', 'HomeController@index')->name('home');
Route::post('/logout', 'Auth\LogoutController@force')->name('logout.force');
Route::get('/logout', 'Auth\LogoutController@index')->name('logout');

## change language
Route::get('language/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
})->name('language');

/**
 * All route in this group can be access only authenticated user
 */
Route::group(['middleware' => 'auth'], function() {

    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->name('logs')->middleware('can:log-view');    

    ###########################################################
    ## OTHERS ##
    ###########################################################
    Route::post('getStaff', 'Misc\AjaxController@getStaff')->name('ajax.getStaff');
    Route::get('search-user', 'Misc\AjaxController@searchUser')->name('ajax.search-user');

    ###########################################################
    ## SELECT2 DROPDOWN ##
    ###########################################################
    Route::prefix('select2')->group(function () {
        Route::post('menus', 'Misc\SelectController@getMenus')->name('select2.menus');
        Route::post('permissions', 'Misc\SelectController@getPermissions')->name('select2.permissions');
        Route::post('faculties', 'Misc\SelectController@getFaculties')->name('select2.faculties');
        Route::post('departments/{id}', 'Misc\SelectController@getDepartments')->name('select2.departments');
        Route::post('divisions/{id}', 'Misc\SelectController@getDivisions')->name('select2.divisions');
        Route::post('sections/{id}', 'Misc\SelectController@getSections')->name('select2.sections');
    });

    ###########################################################
    ## FUNCTION TO READ FILE ##
    ###########################################################
    Route::get('files/read/{id}', 'FileController@read')->name('files.read');
    Route::get('files/download/{id}', 'FileController@download')->name('files.download');
});


if (env('APP_CAS')) {
    Auth::routes(['register' => false]);
    Route::match(['get', 'post'], 'login', function(){
        return redirect('/');
    });
    Route::match(['get', 'post'], 'password/confirm', function(){
        return redirect('/');
    });
    Route::match(['get', 'post'], 'password/email', function(){
        return redirect('/');
    });
    Route::match(['get', 'post'], 'password/reset', function(){
        return redirect('/');
    });
    Route::match(['get'], 'password/reset/{token}', function(){
        return redirect('/');
    });
}
else {
    Auth::routes();
}
// end ignore

// if ada cas, perlu logout redirect ke page /auth/logout sebab nak clearkan session cas dengan laravel auth
Route::post('/auth/logout', 'Auth\LogoutController@cas')->name('cas.logout');

// if declare has cas login, then cas login will enable for user to login 
if (env('HAS_CAS')) {
    // control this page only user with authentication cas will be pass
    Route::group(['middleware' => ['cas.auth']], function () {
        
        // login guna CasController supaya kalau user login guna cas, boleh identify sekali dengan laravel auth permission untuk check role if any
        // Route::get('/cas', 'CasController@index')->name('cas');
    });
}

Route::get('/cas/callback', 'CasController@index')->name('cas.callback');
Route::get('/cas/authenticated', 'CasController@authenticated')->name('cas.authenticated');

Route::get('/cas/login', function() {
    if (Cas::isAuthenticated()) {
        return redirect()->route('cas.callback');
    }
    return Cas::authenticate();
})->name('cas');