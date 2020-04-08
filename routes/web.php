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

Route::get('/buidingWiseReport','ReportController@building')->name('labour.find');
Route::get('/buidingWiseCostReport','ReportController@buildingCostReport')->name('buildingCost.report');
Route::get('/groupWiseCostReport','ReportController@groupCostReport')->name('groupCost.report');
Route::resource('/salarybasedemployee','SalaryBasedEmployeeController');
Route::get('/perbuildingcost/{id}','ReportController@perbuildingcost')->name('perbuilding.cost');
Route::get('/pergroupcost/{id}','ReportController@pergroupcost')->name('pergroup.cost');

Route::get('/employeeBasedReport','ReportController@employeeBasedReport')->name('cost.employeeBasedReport');

Route::get('/downloadXL','ReportController@downloadXL')->name('downloadXL');

Route::get('/addSalary/{id}','SalaryBasedEmployeeController@addSalary')->name('salarybasedemployee.addSalary');
Route::post('/addSalaryStore/{id}','SalaryBasedEmployeeController@addSalaryStore')->name('salarybasedemployee.addSalaryStore');


// Bill Payment Route 
Route::get('billPayment/{id}','LabourController@billPaymentView')->name('labour.billPay');
Route::post('billPaymentStore/{id}','LabourController@billPaymentStore')->name('labour.billPayStore');




    
//ajax call route
Route::get('findBuilding/','LabourController@findBuilding')->name('findBuilding');