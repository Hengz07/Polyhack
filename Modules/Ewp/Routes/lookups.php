<?php

use Illuminate\Support\Facades\Route;
use Modules\Site\Http\Controllers\RoleController;


Route::get('/', 'EwpController@dashboard')->name('ewp.dahsboard');

Route::prefix('survey')->group(function() {
    
    Route::get('/', 'SurveysController@index')->name('ewp.servey.index');

});  

Route::prefix('setup/questions')->group(function() {
        
        Route::get('/', 'QuestionsController@index')->name('ewp.setup.questions');
        Route::get('create', 'QuestionsController@create')->name('ewp.setup.questions.create');
        Route::get('{id}/edit', 'QuestionsController@edit')->name('ewp.setup.questions.edit');
        Route::put('{id}/update', 'QuestionsController@update')->name('ewp.setup.questions.update');
        
        Route::post('store', 'QuestionsController@store')->name('ewp.setup.questions.store');

        Route::delete('/{id}', 'LookupController@destroy')->name('lookup.destroy');
        Route::delete('/{id}', 'QuestionsController@delete')->name('questions.delete');
});

Route::prefix('setup')->group(function() {
        
        Route::get('/scales', 'ScalesController@index')->name('setup.scale');
        Route::get('scale/create', 'ScalesController@create')->name('ewp.setup.scales.create');
        Route::get('scale/{id}/edit', 'ScalesController@edit')->name('ewp.setup.scales.edit');
        Route::put('scale/{id}/update', 'ScalesController@update')->name('ewp.setup.scales.update');
        
        Route::post('store', 'ScalesController@store')->name('ewp.setup.scales.store');

        Route::delete('/{id}', 'LookupController@destroy')->name('lookup.destroy');
        Route::delete('/{id}', 'ScalesController@delete')->name('scales.delete');
});

Route::prefix('setup/schedules')->group(function() {
        
    Route::get('/', 'SchedulesController@index')->name('ewp.setup.schedules');
    Route::get('create', 'SchedulesController@create')->name('ewp.setup.schedules.create');
    Route::get('{id}/edit', 'SchedulesController@edit')->name('ewp.setup.schedules.edit');
    Route::put('{id}/update', 'SchedulesController@update')->name('ewp.setup.schedules.update');
    
    Route::post('store', 'SchedulesController@store')->name('ewp.setup.schedules.store');

    Route::delete('/{id}', 'LookupController@destroy')->name('lookup.destroy');
    Route::delete('/{id}', 'SchedulesController@delete')->name('schedules.delete');
});

Route::prefix('select2')->group(function () {

    Route::post('lookups/category', 'SelectController@getCategory')->name('select2.lookups.category');

});