<?php

use Illuminate\Support\Facades\Route;

//MAIN INDEX

Route::prefix('survey')->group(function() {
    
    Route::get('/{id}', 'SurveysController@index')->name('ewp.survey.index');
    Route::post('/save', 'SurveysController@store')->name('ewp.survey.store');

    Route::get('/answers', 'SurveysController@answers')->name('ewp.survey.answers');
});  

Route::prefix('dashboards/reports')->group(function() {
        
    Route::get('/', 'ReportsController@dashboard')->name('ewp.dashboards.reports');
    Route::get('create', 'ReportsController@create')->name('ewp.dashboards.reports.create');

    Route::post('store', 'ReportsController@store')->name('ewp.dashboards.reports.store');

    //
    Route::get('/result', 'ReportsController@getResult')->name('reports.result');
});

Route::prefix('setup/questions')->group(function() {
        
    Route::get('/', 'QuestionsController@index')->name('ewp.setup.questions');
    Route::get('create', 'QuestionsController@create')->name('ewp.setup.questions.create');
    Route::get('{id}/edit', 'QuestionsController@edit')->name('ewp.setup.questions.edit');
    Route::put('{id}/update', 'QuestionsController@update')->name('ewp.setup.questions.update');
        
    Route::post('store', 'QuestionsController@store')->name('ewp.setup.questions.store');

    Route::delete('/{id}', 'QuestionsController@destroy')->name('questions.delete');
});

Route::prefix('lookup')->group(function() {
        
    Route::get('/', 'LookupController@index')->name('ewp.lookup.index');
    
    Route::get('create', 'LookupController@create')->name('ewp.lookup.create');
    Route::post('store', 'LookupController@store')->name('ewp.lookup.store');

    Route::get('{id}/edit', 'LookupController@edit')->name('ewp.lookup.edit');
    Route::put('{id}/update', 'LookupController@update')->name('ewp.lookup.update');
});

Route::prefix('setup')->group(function() {
        
    Route::get('/scales', 'ScalesController@index')->name('setup.scale');
    Route::get('scale/create', 'ScalesController@create')->name('ewp.setup.scales.create');
    Route::get('scale/{id}/edit', 'ScalesController@edit')->name('ewp.setup.scales.edit');
    Route::put('scale/{id}/update', 'ScalesController@update')->name('ewp.setup.scales.update');
        
    Route::post('store', 'ScalesController@store')->name('ewp.setup.scales.store');

    Route::delete('/{id}/delete', 'ScalesController@destroy')->name('scales.delete');
});

Route::prefix('setup/schedules')->group(function() {
    
    Route::get('/', 'SchedulesController@index')->name('ewp.setup.schedules');
    Route::get('create', 'SchedulesController@create')->name('ewp.setup.schedules.create');
    Route::get('{id}/edit', 'SchedulesController@edit')->name('ewp.setup.schedules.edit');
    Route::put('{id}/update', 'SchedulesController@update')->name('ewp.setup.schedules.update');
    
    Route::post('store', 'SchedulesController@store')->name('ewp.setup.schedules.store');

    Route::post('/{id}', 'SchedulesController@destroy')->name('ewp.setup.schedules.destroy');
});

Route::prefix('/dashboards')->group(function() {

    Route::get('/dashboard', 'EwpController@index')->name('ewp.dashboards.index');
    Route::get('/admin_dash', 'EwpController@adminindex')->name('ewp.dashboards.admin_dash');
});

Route::prefix('assign')->group(function() {

    Route::get('/', 'AssignController@index')->name('ewp.assign.index');
    Route::get('create', 'AssignController@create')->name('ewp.assign.create');
    
    Route::post('store', 'AssignController@store')->name('ewp.assign.store');

    Route::get('information', 'AssignController@information')->name('ewp.assign.information');

});  

Route::prefix('specialrecord')->group(function() {

    Route::get('/', 'SpecialRecordController@index')->name('ewp.specialrecord.index');
    Route::get('create', 'SpecialRecordController@create')->name('ewp.specialrecord.create');
    Route::post('store', 'SpecialRecordController@store')->name('ewp.specialrecord.store');
    
    Route::get('{id}/edit', 'SpecialRecordController@edit')->name('ewp.specialrecord.edit');
    Route::put('{id}/update', 'SpecialRecordController@update')->name('ewp.specialrecord.update');

    // Route::get('summary', 'SpecialRecordController@summary')->name('ewp.specialrecord.summary');

}); 

Route::prefix('select2')->group(function () {

    Route::post('lookups/category', 'SelectController@getCategory')->name('select2.lookups.category');
    
    Route::post('/session', 'SelectController@getSession')->name('select2.session');
    Route::post('/semester', 'SelectController@getSemester')->name('select2.semester');
    Route::post('/faculty', 'SelectController@getFaculty')->name('select2.faculty');
    Route::post('/status', 'SelectController@getStatus')->name('select2.status');
    Route::post('/officer', 'SelectController@getOfficer')->name('select2.officer');
    Route::post('/modalOfficer', 'SelectController@getModalOfficer')->name('select2.modalOfficer');
});