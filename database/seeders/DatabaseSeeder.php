<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database with 10 users & employees.
     */
    public function run(): void
    {
        $employees = [
            // HR Admins (can add/edit/delete) 
            ['name' => 'Siti Nurul Rahman', 'email' => 'siti.nurul@company.com', 'role' => 'hr_admin', 'department' => 'Human Resource', 'gender' => 'Female', 'nationality' => 'Malaysian'],
            ['name' => 'Rajesh Kumar', 'email' => 'rajesh.kumar@company.com', 'role' => 'hr_admin', 'department' => 'Human Resource', 'gender' => 'Male', 'nationality' => 'Indian'],

            // Regular Employees (view only) 
            ['name' => 'Ahmad Bin Hassan', 'email' => 'ahmad.hassan@company.com', 'role' => 'employee', 'department' => 'Information Technology', 'gender' => 'Male', 'nationality' => 'Malaysian'],
            ['name' => 'Wei Chen', 'email' => 'wei.chen@company.com', 'role' => 'employee', 'department' => 'Marketing', 'gender' => 'Male', 'nationality' => 'Chinese'],
            ['name' => 'Priya Sharma', 'email' => 'priya.sharma@company.com', 'role' => 'employee', 'department' => 'Finance', 'gender' => 'Female', 'nationality' => 'Indian'],
            ['name' => 'Lee Ming Hui', 'email' => 'lee.ming@company.com', 'role' => 'employee', 'department' => 'Engineering', 'gender' => 'Female', 'nationality' => 'Chinese'],
            ['name' => 'Arjun Patel', 'email' => 'arjun.patel@company.com', 'role' => 'employee', 'department' => 'Sales', 'gender' => 'Male', 'nationality' => 'Indian'],
            ['name' => 'Nurliza Binti Zain', 'email' => 'nurliza.zain@company.com', 'role' => 'employee', 'department' => 'Operations', 'gender' => 'Female', 'nationality' => 'Malaysian'],
            ['name' => 'Zhang Wei', 'email' => 'zhang.wei@company.com', 'role' => 'employee', 'department' => 'Information Technology', 'gender' => 'Male', 'nationality' => 'Chinese'],
            ['name' => 'Divya Nair', 'email' => 'divya.nair@company.com', 'role' => 'employee', 'department' => 'Human Resource', 'gender' => 'Female', 'nationality' => 'Indian'],
        ];

        foreach ($employees as $data) {
            // Create user account first
            $user = User::create([
                'email' => $data['email'],
                'password' => Hash::make('password'),
                'role' => $data['role'],
                'status' => 'Active',
            ]);

            // Auto-generate employee ID based on department
            $employeeId = Employee::generateEmployeeId($data['department']);

            // Create the employee record linked to the user
            Employee::create([
                'user_id' => $user->id,
                'employee_id' => $employeeId,
                'name' => $data['name'],
                'department' => $data['department'],
                'gender' => $data['gender'],
            ]);
        }

    }
}