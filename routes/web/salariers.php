<?php


use Illuminate\Support\Facades\Route;

// Employee Salary routes
Route::get('employees', ['as' => 'employees.index', 'uses' => 'EmployeeSalaryController@index']);
Route::get('employees/create', ['as' => 'employees.create', 'uses' => 'EmployeeSalaryController@create']);
Route::post('employees', ['as' => 'employees.store', 'uses' => 'EmployeeSalaryController@store']);
Route::get('employees/{employee}', ['as' => 'employees.show', 'uses' => 'EmployeeSalaryController@show']);
Route::get('employees/{employee}/edit', ['as' => 'employees.edit', 'uses' => 'EmployeeSalaryController@edit']);
Route::put('employees/{employee}', ['as' => 'employees.update', 'uses' => 'EmployeeSalaryController@update']);
Route::delete('employees/{employee}', ['as' => 'employees.destroy', 'uses' => 'EmployeeSalaryController@destroy']);

// Salary routes
Route::get('salaries', ['as' => 'salaries.index', 'uses' => 'SalaryController@index']);
Route::get('salaries/create', ['as' => 'salaries.create', 'uses' => 'SalaryController@create']);
Route::post('salaries', ['as' => 'salaries.store', 'uses' => 'SalaryController@store']);
Route::get('salaries/{salary}/edit', ['as' => 'salaries.edit', 'uses' => 'SalaryController@edit']);
Route::put('salaries/{salary}', ['as' => 'salaries.update', 'uses' => 'SalaryController@update']);
Route::delete('salaries/{salary}', ['as' => 'salaries.destroy', 'uses' => 'SalaryController@destroy']);
Route::get('my-salaries', ['as' => 'salaries.user', 'uses' => 'SalaryController@showUserSalaries']);

// API route for fetching employees
Route::get('/api/employees', ['as' => 'employees.get', 'uses' => 'SalaryController@getEmployees']);


// Attendances

Route::get('users/{user}/attendances', ['as' => 'users.attendances', 'uses' => 'AttendanceController@index']);
Route::get('users/{user}/attendances/create', ['as' => 'users.attendances.create', 'uses' => 'AttendanceController@create']);
Route::post('users/{user}/attendances', ['as' => 'users.attendances.store', 'uses' => 'AttendanceController@store']);
