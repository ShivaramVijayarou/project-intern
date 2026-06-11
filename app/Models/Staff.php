<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Staff extends Model
{
    protected $fillable = [
        'staff_id',
        'name',
        'email',
        'phone',
        'ic_no',
        'department',
        'level',
        'start_date',
        'status',
        'profileimage'
    ];

    protected $casts = [
        'start_date' => 'date',
    ];

    public function families()
    {
        return $this->hasMany(StaffFamily::class, 'staff_id');
    }
}
    