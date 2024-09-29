<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    protected $fillable = ['course_id', 'pertemuan', 'video'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
