<?php

namespace App\Models;

use App\Models\Admin;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['judul', 'deskripsi', 'thumbnail', 'admin_id',];

    public function contents()
    {
        return $this->hasMany(Content::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    protected static function booted()
    {
        static::saving(function ($course) {
            if (empty($course->slug)) {
                $course->slug = Str::slug($course->judul, '-');
            }
        });
    }
}
