<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $table = 'guru';

    protected $primaryKey = 'id_guru';

    protected $fillable = [
        'nip',
        'nama',
        'alamat',
        'jenis_kelamin',
        'foto_profil',
        'id_mata_pelajaran',
        'id_user'
    ];
    public function subjects()
    {
        return $this->hasMany(Course::class, 'id_mata_pelajaran');
    }
    public function userWeb()
    {
        return $this->belongsTo(UserWeb::class);
    }
    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'kelas_id');
    }
    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'id_guru');
    }
}
