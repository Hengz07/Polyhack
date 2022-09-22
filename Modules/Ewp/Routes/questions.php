<?php

use Illuminate\Support\Facades\Route;
use Modules\Site\Http\Controllers\RoleController;


Route::get('/', 'EwpController@index')->name('ewp.dahsboard');


Route::prefix('setup')->group(function() {
        
        Route::get('/questions', 'QuestionsController@index')->name('ewp.setup.questions');
        Route::get('/questions/create', 'QuestionsController@create')->name('ewp.setup.questions.create');
        Route::get('/questions/{id}/edit', 'QuestionsController@edit')->name('setup.questions.edit');

        Route::get('/scales', 'ScalesController@index')->name('setup.scale');

    });

Route::prefix('survey')->group(function() {
    
    Route::get('/', 'SurveysController@index')->name('ewp.servey.index');

});