<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'absensi';

    protected $primaryKey = 'id_absensi';

    protected $fillable = [
        'tanggal_absensi',
        'kelas_id',
        'id_jadwal',
        'id_user',
        'id_siswa',
        'mata_pelajaran_id',        
        'catatan',
        'status_absensi',
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

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }
    public function jadwal()
    {
        return $this->belongsTo(Schedule::class, 'id_jadwal');
    }
    public function user()
    {
        return $this->belongsTo(UserWeb::class, 'id_user');
    }
    
}
