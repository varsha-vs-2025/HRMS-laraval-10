<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Attendance;

class DashboardController extends Controller
{
    public function index()
    {
        $employeeCount = Employee::count();
        $attendanceCountToday = Attendance::whereDate('created_at', today())->count();
        $endingContracts = Employee::getEndingContractEmployees();

        return view('pages.dashboard', compact('employeeCount', 'attendanceCountToday', 'endingContracts'));
    }
}
