<?php


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\LeaveRequestController;


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
Route::prefix('users/{user}')->group(function () {
    Route::get('attendances', [AttendanceController::class, 'index'])->name('users.attendances');
    Route::get('attendances/create', [AttendanceController::class, 'create'])->name('attendances.create');
    Route::post('attendances', [AttendanceController::class, 'store'])->name('attendances.store');
});



// Leave request routes
Route::get('user/leaves', [LeaveRequestController::class, 'userIndex'])->name('user.leaves.index');
Route::get('user/leaves/create', [LeaveRequestController::class, 'userCreate'])->name('user.leaves.create');
Route::post('user/leaves/store', [LeaveRequestController::class, 'userStore'])->name('user.leaves.store');



// Admin Check Leave Request 
Route::get('admin/leaves', [LeaveRequestController::class, 'adminIndex'])->name('admin.leaves.index');
Route::put('admin/leaves/{leaveRequest}', [LeaveRequestController::class, 'adminUpdate'])->name('admin.leaves.update');

// Get Admin All record of attendance  and leave 
Route::get('records', [AttendanceController::class, 'getRecord'])->name('admin.records.index');
