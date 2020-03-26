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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/dashboard','HomeController@dashboard')->name('dashboard');

Route::resource('/group','GroupController');
Route::resource('/building','BuildingController');
Route::resource('/labourType','LabourTypeController');
Route::get('addAttendence/{id}','LabourController@addAttendence')->name('labour.addAttendence');
Route::put('addAttendence/{id}/store','LabourController@addAttendenceStore')->name('labour.addAttendenceStore');
Route::resource('/labour','LabourController');


