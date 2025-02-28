<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;

    protected $table = 'kelas';

    protected $primaryKey = 'id_kelas';

    protected $fillable = [
        'nama_kelas',
        'tingkat_kelas',
        'tahun_ajaran',
        'id_user'
    ];


    // Tambahkan relasi untuk jadwal pelajaran
    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'kelas_id');
    }
    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'kelas_id');
    }

    public function students()
    {
        return $this->hasMany(Siswa::class, 'kelas_id');
    }
}
