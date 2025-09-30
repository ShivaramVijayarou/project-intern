<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Result extends Model
{
    //
     use HasFactory;
     protected $fillable = ['program','level','file_name', 'file_path'];
}
