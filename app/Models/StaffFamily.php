<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StaffFamily extends Model
{
    protected $table = 'staff_family';

    protected $fillable = [
        'staff_id',
        'name',
        'relationship',
        'phone',
        'email',
        'occupation',
        'company_address'
    ];

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }
}
