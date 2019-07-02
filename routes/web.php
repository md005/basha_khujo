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

//##########
//frontend
//##########
Route::get('/', function () {
    return view('welcome');
});
//home page load
//Route::get('/', 'HomeController@index');


//##########
//backend
//##########
//admin login authentication
Route::get('/admin-panel', 'AdminController@index');
Route::post('/admin-panel-login', 'AdminController@adminLogin');
Route::get('/dashboard', 'SuperAdminController@index');
Route::get('/logout', 'SuperAdminController@logout');

//user section
Route::get('/add-user', 'UserController@addUser');
Route::post('/save-user', 'UserController@saveUser');
Route::get('/manage-user', 'UserController@manageUser');
Route::get('unpublish-user-status/{id}', 'UserController@unpublishUser');
Route::get('publish-user-status/{id}', 'UserController@publishUser');
Route::get('delete-user/{id}', 'UserController@deleteUser');
Route::get('edit-user/{id}', 'UserController@editUser');
Route::post('update-user', 'UserController@updateUser');

