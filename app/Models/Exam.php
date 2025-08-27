<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    //

    protected $fillable = [
    'program',
    'course_code',
    'course_name',
    'exam_date',
    'time_from',
    'time_to',
];
}
