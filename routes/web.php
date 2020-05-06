<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile', 'HomeController@profile')->name('profile');
Route::get('/contacts', function () {
    return view('contacts');
})->name('contacts');

Route::get('/subject/new', 'SubjectsController@newSubject')->name('newSubjectForm');
Route::post('/subject/new', 'SubjectsController@validateForm')->name('newSubjectPost');
Route::get('/subject/{id}/togglePrivacy', 'SubjectsController@togglePrivacy')->name('togglePrivacy');
Route::get('/subject/{id}', 'SubjectsController@profile')->name('subjectProfile');
Route::get('/subject/{id}/edit', 'SubjectsController@edit')->name('subjectEdit');
Route::get('/subject/{id}/delete', 'SubjectsController@delete')->name('subjectDelete');