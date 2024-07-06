<?php

namespace App\Http\Controllers;

use App\Salary;
use App\EmployeeSalary;
use Illuminate\Http\Request;
use Auth;

class SalaryController extends Controller
{
    public function index()
    {
        $salaries = Salary::with('employee')->get();
        return view('salaries.index', compact('salaries'));
    }


    public function create()
    {
        return view('salaries.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => 'required:employee_salaries,id',
            'email' => 'required|email',
            'amount' => 'required|numeric',
            'payment_date' => 'required|date',
            'remarks' => 'nullable|string',
        ]);

        Salary::create($validated);

        return redirect()->route('salaries.index')->with('success', 'Salary added successfully.');
    }

    public function edit($id)
    {
        $employees = EmployeeSalary::all();
        $salary = Salary::findOrFail($id);
        return view('salaries.edit', compact('salary', 'employees'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'amount' => 'required|numeric',
            'payment_date' => 'required|date',
            'remarks' => 'nullable|string',
        ]);


        $salary = Salary::findOrFail($id);
        $salary->update($validated);

        return redirect()->route('salaries.index')->with('success', 'Salary updated successfully.');
    }

    public function destroy($id)
    {
        $salary = Salary::findOrFail($id);
        $salary->delete();

        return redirect()->route('salaries.index')->with('success', 'Salary deleted successfully.');
    }

    public function getEmployees()
    {
        $employees = EmployeeSalary::all();
        return response()->json($employees);
    }


    // For user Side 

    public function showUserSalaries()
    {
        $userEmail = Auth::user()->email;
        $salaries = Salary::where('email', $userEmail)->get();
        return view('salaries.user', compact('salaries'));
    }
}
