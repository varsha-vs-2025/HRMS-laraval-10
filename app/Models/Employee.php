<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Attendance;
use App\Models\EmployeeLeave;
use Carbon\Carbon;

class Employee extends Model
{
    use HasFactory;

    protected $guarded = [];

    // ======================
    // Relationships
    // ======================

    /**
     * Each employee belongs to a user (for login).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * An employee has many attendance records.
     */
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    /**
     * An employee may have many leave requests.
     */
    public function leaveRequests()
    {
        return $this->hasMany(EmployeeLeave::class);
    }

    /**
     * ✅ Get employees whose contracts end within the next 30 days.
     */
    public static function getEndingContractEmployees()
    {
        return self::whereDate('contract_end_date', '<=', Carbon::now()->addDays(30))->get();
    }
}
