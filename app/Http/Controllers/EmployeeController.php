<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all();

        return view('employee.index', [
            'items' => $employees
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name123' => 'required|string|max:255',
            'last_name123' => 'required|string|max:255',
            'job123' => 'required|string|max:255',
            'phone_number123' => 'required|string|max:20|regex:/^[0-9+\-\s]+$/',
            'salary123' => 'required|numeric|min:0',
        ]);

        Employee::create([
            'first_name' => $validated['first_name123'],
            'last_name' => $validated['last_name123'],
            'job' => $validated['job123'],
            'phone_number' => $validated['phone_number123'],
            'salary' => $validated['salary123']
        ]);

        return redirect()->back();
    }
    //
}
