<?php

namespace App\Http\Controllers;

use App\EmployeeSalary;
use Illuminate\Http\Request;

class EmployeeSalaryController extends Controller
{
    public function index()
    {
        $employeeSalaries = EmployeeSalary::all();
        return view('employeessalarys.index', compact('employeeSalaries'));
    }

    public function create()
    {
        return view('employeessalarys.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required', 
            'salary' => 'required|numeric',
            'bank_name' => 'nullable|string',
            'bank_account_number' => 'nullable|string',
            'ifsc_code' => 'nullable|string',
        ]);

        EmployeeSalary::create($validated);

        return redirect()->route('employees.index')->with('success', 'Employee salary added successfully.');
    }

    public function show(EmployeeSalary $employee)
    {
        return view('employeessalarys.show', compact('employee'));
    }

    public function edit(EmployeeSalary $employee)
    {
        return view('employeessalarys.edit', compact('employee'));
    }

    public function update(Request $request, EmployeeSalary $employee)
    {
        $validated = $request->validate([
            'name' => 'required',
            'salary' => 'required|numeric',
            'bank_name' => 'nullable|string',
            'bank_account_number' => 'nullable|string',
            'ifsc_code' => 'nullable|string',
        ]);

        $employee->update($validated);

        return redirect()->route('employees.index')->with('success', 'Employee salary updated successfully.');
    }

    public function destroy(EmployeeSalary $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee salary deleted successfully.');
    }
}
