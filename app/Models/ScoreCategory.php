<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScoreCategory extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Define relationship to Employee
 public function employee()
{
    return $this->belongsTo(Employee::class);
}


    // Optional custom pagination
    public function paginate($count = 10) 
    {
        return $this->orderBy('id', 'ASC')->paginate($count);
    }
}
