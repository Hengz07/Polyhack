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



Route::prefix('ewp')->group(function() {
    Route::group(['middleware' => 'auth'], function() {
        foreach (glob(__DIR__. '/*') as $router_files){
            (basename($router_files =='web.php')) ? : (require_once $router_files);
        }
    });
});