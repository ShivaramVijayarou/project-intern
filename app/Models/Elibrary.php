<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Elibrary extends Model
{
    //
     use HasFactory;
    protected $fillable = ['program', 'file_name', 'file_path'];
}
