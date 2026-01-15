<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attendance extends Model
{
    use HasFactory;
    //
    protected $fillable = ['student_id','date', 'status', 'evidence'];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id' );

    }
}

