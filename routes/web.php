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




Auth::routes();

Route::middleware(['auth'])->group(function () {
    
    Route::get('/', 'HomeController@index')->name('home');

    Route::get('/create', 'UserController@index');

    
    Route::get('users/{user}',  ['as' => 'users.edit', 'uses' => 'UserController@edit']);
    Route::patch('users/{user}/update',  ['as' => 'users.update', 'uses' => 'UserController@update']);

    
    Route::get('/backlog', 'BacklogController@index');
    Route::get('/404', 'NotFoundController@index');

    
    Route::delete('/checklist_remove/{id}/{name}', 'ChecklistController@destroy');
    Route::put('/checklist_update/{id}/{status}/{name}', 'ChecklistController@update');
    Route::get('/checklist', 'ChecklistController@store');

    Route::resource('/issues', 'IssuesController');
    
    Route::resource('/comments', 'CommentsController');

    Route::resource('/sprints', 'SprintController');

    Route::resource('/projects', 'ProjectsController');

    Route::get('/home', 'HomeController@index')->name('home');
});