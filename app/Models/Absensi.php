<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'absensi';
    protected $fillable = [
        'id_siswa',
        'id_guru',
        'id_course',
        'id_content',
        'status',
        'keterangan',
        'foto_absensi',
        'longitude',
        'latitude',
    ];
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }
    public function guru()
    {
        return $this->belongsTo(Admin::class, 'id_guru');
    }
    public function course()
    {
        return $this->belongsTo(Course::class, 'id_course');
    }
    public function content()
    {
        return $this->belongsTo(Content::class, 'id_content');
    }
    public function getStatusAttribute($value)
    {
        return ucfirst($value);
    }
    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = strtolower($value);
    }
}
