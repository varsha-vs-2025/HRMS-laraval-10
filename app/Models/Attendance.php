<?php
// App\Models\Attendance.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function attendanceTime()
    {
        return $this->belongsTo(AttendanceTime::class);
    }

    public function attendanceType()
    {
        return $this->belongsTo(AttendanceType::class);
    }

    public function getPaginatedAttendances($count = 10, $filterEmployeeId = null)
    {
        $query = $this->with(['employee.user', 'attendanceTime', 'attendanceType'])
                     ->latest();

        if (!auth()->user()->isAdmin()) {
            $employee = auth()->user()->employee;
            if (!$employee) return collect([]);
            $query->where('employee_id', $employee->id);
        } elseif ($filterEmployeeId) {
            $query->where('employee_id', $filterEmployeeId);
        }

        return $query->paginate($count);
    }
}
