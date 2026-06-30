<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('hr.admin')->only(['create', 'store', 'edit', 'update', 'destroy']);
    }

    public function index(Request $request): View
    {
        $query = Employee::query();

        //Search functionality
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('employee_id', 'like', "%{$search}%")
                    ->orWhere('department', 'like', "%{$search}%");
            });
        }

        $employees = $query->orderBy('name')->paginate(10)->withQueryString();
        return view('employees.index', compact('employees'));
    }

    public function create(): View
    {
        return view('employees.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:' . User::class,
            'password' => 'required|string|min:8',
            'role' => 'required|in:employee,hr_admin',
            'status' => 'required|in:Active,Suspend',
            'department' => 'required|string|max:100',
            'gender' => 'required|in:Male,Female,Other',
        ]);

        // Create the user account (name is nullable — we store it from employee)
        $user = User::create([
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'status' => $validated['status'],
        ]);

        // Auto-generate employee ID based on department
        $employeeId = Employee::generateEmployeeId($validated['department']);

        // Create the employee record linked to the user
        Employee::create([
            'user_id' => $user->id,
            'employee_id' => $employeeId,
            'name' => $validated['name'],
            'department' => $validated['department'],
            'gender' => $validated['gender'],
        ]);

        return redirect()->route('employees.index')
            ->with('success', 'Employee added successfully. Employee ID: ' . $employeeId);
    }

    public function show(Employee $employee): View
    {
        $employee->load('user');
        return view('employees.show', compact('employee'));
    }

    public function edit(Employee $employee): View
    {
        $employee->load('user');
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, Employee $employee): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'department' => 'required|string|max:100',
            'gender' => 'required|in:Male,Female,Other',
            'status' => 'required|in:Active,Suspend',
            'role' => 'required|in:employee,hr_admin',
        ]);

        $employee->update([
            'name' => $validated['name'],
            'department' => $validated['department'],
            'gender' => $validated['gender'],
        ]);

        $employee->user->update([
            'status' => $validated['status'],
            'role' => $validated['role'],
        ]);

        return redirect()->route('employees.index')
            ->with('success', 'Employee updated successfully.');
    }

    public function destroy(Employee $employee): RedirectResponse
    {
        $employee->delete();

        return redirect()->route('employees.index')
            ->with('success', 'Employee deleted successfully.');
    }
}
