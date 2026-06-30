<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalEmployees = Employee::count();
        $departmentStats = Employee::select('department', \Illuminate\Support\Facades\DB::raw('count(*) as total'))
            ->groupBy('department')
            ->orderBy('total', 'asc')
            ->get();

        $recentHires = Employee::latest()->take(5)->get();

        return view('dashboard', compact('totalEmployees', 'departmentStats', 'recentHires'));
    }
}