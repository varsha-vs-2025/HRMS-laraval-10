<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    // ✅ Check if this role is admin
    public function isAdmin()
    {
        return strtolower($this->name) === 'admin'; // make sure your roles table uses 'admin'
    }
}
