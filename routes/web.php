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
Route::get('/subject/new', 'SubjectsController@newSubject')->name('newSubjectForm');
Route::post('/subject/new', 'SubjectsController@validateForm')->name('newSubjectPost');
Route::get('/subject/{id}/togglePrivacy', 'SubjectsController@togglePrivacy')->name('togglePrivacy');
Route::get('/subject/{id}', 'SubjectsController@profile')->name('subjectProfile');
Route::get('/subject/{id}/edit', 'SubjectsController@edit')->name('subjectEdit');
Route::get('/subject/{id}/delete', 'SubjectsController@delete')->name('subjectDelete');
Route::get('/subject/{id}/subscribe', 'SubjectsController@subscribe')->name('subscribe');
Route::get('/subject/{id}/unSubscribe', 'SubjectsController@unSubscribe')->name('unSubscribe');