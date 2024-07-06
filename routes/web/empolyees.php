<?php

// Index
Route::get('employees', ['as' => 'employees.index', 'uses' => 'EmployeesalaryController@index']);

// Create
Route::get('employees/create', ['as' => 'employees.create', 'uses' => 'EmployeesalaryController@create']);

// Store
Route::post('employees', ['as' => 'employees.store', 'uses' => 'EmployeesalaryController@store']);

// Show
Route::get('employees/{employee}', ['as' => 'employees.show', 'uses' => 'EmployeesalaryController@show']);

// Edit
Route::get('employees/{employee}/edit', ['as' => 'employees.edit', 'uses' => 'EmployeesalaryController@edit']);

// Update
Route::put('employees/{employee}', ['as' => 'employees.update', 'uses' => 'EmployeesalaryController@update']);

// Destroy
Route::delete('employees/{employee}', ['as' => 'employees.destroy', 'uses' => 'EmployeesalaryController@destroy']);
