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

// Route::get('/', function () {
//     return view('welcome');
// });

//
// Route::get('/about', function () {
//     return view('welcome0');
// });
//
//
// Route::get('/db', function () {
//     return view('welcome0');
// });

Route::get('/test', 'TestController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');
Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/editProfile', 'HomeController@index')->name('editProfile');


Route::resource('subjects', 'SubjectController');
Route::resource('user', 'UserController', [
    'except' => ['create', 'user.index']
]);
Route::resource('classrooms', 'ClassroomController');
Route::resource('grades', 'GradeController');
Route::get('user/create/{role}', 'UserController@create')->name('user.create.role');
Route::get('user/list/{role}', 'UserController@index')->name('user.list.role');
