<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    //
    protected $fillable = ['title', 'description', 'file', 'program', 'level', 'uploaded_by'];





public function uploader()
{
    return $this->belongsTo(User::class, 'uploaded_by');
}

}


