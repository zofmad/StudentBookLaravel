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
    'except' => ['create', 'index', 'edit', 'show']
]);
Route::resource('classrooms', 'ClassroomController');
Route::resource('grades', 'GradeController');
Route::get('user/create/{role}', 'UserController@create')->name('user.create.role');
Route::get('user/list/{role}', 'UserController@index')->name('user.list.role');
Route::get('user/show/{role?}/{user?}', 'UserController@show')->name('user.show.role');
Route::get('user/edit/{role?}/{user?}', 'UserController@edit')->name('user.edit.role');
Route::get('user/changePassword/{role?}/{user?}', 'UserController@changePassword')->name('user.changePassword.role');
//Route::match(array('PUT', 'PATCH'), "user/pass/{user}", array(
//      'uses' => 'UserController@updatePassword',
//      'as' => 'user.updatePassword'
//));
 Route::post('user/pass/{user?}', 'UserController@updatePassword')->name('user.updatePassword');
 Route::get('subject/teacher/list', 'SubjectController@indexForTeacher')->name('subjects.list.teacher');
 Route::get('grade/teacher/list', 'GradeController@indexForTeacher')->name('grades.list.teacher');
  Route::get('gradesHistory/teacher', 'GradeController@showGradesHistoryForTeacher')->name('grades.history.teacher');
  Route::get('grade/student/list', 'GradeController@showGradesForstudent')->name('grades.list.student');
