<?php
// App\Http\Controllers\AttendancesController.php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\AttendanceTime;
use App\Models\AttendanceType;
use App\Models\Employee;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AttendancesController extends Controller
{
    private $attendances;
    private $attendanceTimes;
    private $attendanceTypes;

    public function __construct()
    {
        $this->middleware('auth');

        $this->attendances = resolve(Attendance::class);
        $this->attendanceTimes = AttendanceTime::all();
        $this->attendanceTypes = AttendanceType::all();
    }

    public function index(Request $request)
    {
        $filterEmployeeId = $request->get('employee_id');

        $attendances = (new Attendance)->getPaginatedAttendances(10, $filterEmployeeId);

        $employees = auth()->user()->isAdmin()
            ? \App\Models\Employee::with('user')->get()
            : null;

        return view('pages.attendances', compact('attendances', 'employees', 'filterEmployeeId'));
    }

    public function store(Request $request)
    {
        $now = Carbon::now('Asia/Kolkata');
        $employee = auth()->user()->employee;
        if (!$employee) {
            return back()->with('status', 'No employee linked to this user.');
        }

        $today = Carbon::today('Asia/Kolkata');
        $existing = Attendance::whereDate('created_at', $today)
            ->where('employee_id', $employee->id)
            ->pluck('attendance_time_id')
            ->toArray();

        $inId = $this->getId($this->attendanceTimes, 'IN');
        $outId = $this->getId($this->attendanceTimes, 'OUT');
        $ontimeId = $this->getId($this->attendanceTypes, 'ONTIME');

        if (!in_array($inId, $existing)) {
            $this->attendances->create([
                'employee_id' => $employee->id,
                'attendance_time_id' => $inId,
                'attendance_type_id' => $ontimeId,
            ]);
            return back()->with('status', '✅ Check-in recorded.');
        }

        if (!in_array($outId, $existing)) {
            $this->attendances->create([
                'employee_id' => $employee->id,
                'attendance_time_id' => $outId,
                'attendance_type_id' => $ontimeId,
            ]);
            return back()->with('status', '✅ Check-out recorded.');
        }

        return back()->with('status', '⚠️ Already checked in and out.');
    }

    public function getId($collection, $type)
    {
        return $collection->firstWhere('name', $type)?->id;
    }

    public function print()
    {
        $attendances = Attendance::all();
        return view('pages.attendances_print', compact('attendances'));
    }
}
