<?php

use Illuminate\Support\Facades\Route;

Route::get('/contacts', function () {
    return view('contacts');
})->name('contacts');

Auth::routes(['reset' => false]);

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile', 'HomeController@profile')->name('profile');

Route::get('/subject/list', 'SubjectsController@list')->name('subjectsList');
Route::get('/subject/new', 'SubjectsController@new')->name('newSubjectForm');
Route::post('/subject/new', 'SubjectsController@validateForm')->name('newSubjectPost');
Route::get('/subject/{id}/togglePrivacy', 'SubjectsController@togglePrivacy')->name('togglePrivacy');
Route::get('/subject/{id}', 'SubjectsController@profile')->name('subjectProfile');
Route::get('/subject/{id}/edit', 'SubjectsController@edit')->name('subjectEdit');
Route::get('/subject/{id}/delete', 'SubjectsController@delete')->name('subjectDelete');
Route::get('/subject/{id}/subscribe', 'SubjectsController@subscribe')->name('subscribe');
Route::get('/subject/{id}/unSubscribe', 'SubjectsController@unSubscribe')->name('unSubscribe');

Route::get('/taskList', 'TasksController@list')->name('taskList');
Route::get('/subject/{id}/task/new', 'TasksController@new')->name('newTaskForm');
Route::post('/subject/{id}/task/new', 'TasksController@validateForm')->name('newTaskPost');
Route::get('/task/{id}', 'TasksController@profile')->name('taskProfile');
Route::get('/task/{id}/edit', 'TasksController@edit')->name('taskEdit');
Route::get('/task/{id}/delete', 'TasksController@delete')->name('taskDelete');

Route::get('/task/{id}/solve', 'SolutionsController@new')->name('newSolution');
Route::post('/task/{id}/solve', 'SolutionsController@validateForm')->name('newSolution');
Route::get('/solution/{id}/valuate', 'SolutionsController@valuate')->name('solutionValuate');
Route::post('/solution/valuate', 'SolutionsController@valuatePost')->name('valuatePost');
Route::get('/solution/{id}/download', 'SolutionsController@download')->name('solutionDownload');
