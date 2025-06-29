<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'created_by'];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    protected $guarded = [];

    // Relationships
    public function creator() {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function department() {
        return $this->belongsTo(Department::class);
    }

    // Fetch latest announcements (without department restriction)
    public function getLatestAnnouncements($count = 3) {
        return self::whereNull('department_id')->latest()->take($count)->get();
    }

    // Paginate announcements with relations
    public function scopePaginateAnnouncements($query, $count = 10) {
        return $query->with(['creator', 'department'])->latest()->paginate($count);
    }

    // Corrected Date Formatting
    public function getCreatedAtFormattedAttribute() {
        return Carbon::parse($this->created_at)->format('d-m-Y H:i:s');
    }

    // Automatically cast dates
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
