<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $table = 'jadwal_pelajaran';

    protected $primaryKey = 'id_jadwal';

    protected $fillable = [
        'kelas_id',       
        'mata_pelajaran_id',
        'guru_id',
        'id_jam',
        'id_user',
    ];

    public function kelas()
    {
        return $this->belongsTo(Classes::class, 'kelas_id');
    }

    public function mataPelajaran()
    {
        return $this->belongsTo(Course::class, 'mata_pelajaran_id');
    }

    public function guru()
    {
        return $this->belongsTo(Teacher::class, 'guru_id');
    }

    public function user()
    {
        return $this->belongsTo(UserWeb::class, 'id_user');
    }

    public function hours()
    {
        return $this->belongsTo(Hours::class, 'id_jam');
    }
    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'id_jadwal');
    }
}
