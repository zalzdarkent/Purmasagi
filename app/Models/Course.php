<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['judul', 'deskripsi'];

    public function contents()
    {
        return $this->hasMany(Content::class);
    }
}
