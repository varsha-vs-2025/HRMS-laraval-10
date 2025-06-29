<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User; // ✅ Import User model

class EmployeeLeave extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id', 
        'leave_type', 
        'start_date', 
        'end_date', 
        'reason', 
        'status'
    ];

    // ✅ Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }
}
