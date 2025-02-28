<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $table = 'mata_pelajaran';

    protected $primaryKey = 'id_mata_pelajaran';

    protected $fillable = [
        'id_user',
        'nama_mata_pelajaran',
        'deskripsi_mata_pelajaran'
    ];
    // Model Subject
    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'id_mata_pelajaran');
    }
    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'kelas_id');
    }
    public function Absensi()
    {
        return $this->hasMany(Absensi::class, 'id_mata_pelajaran');
    }

}
