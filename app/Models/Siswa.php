<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';

    protected $primaryKey = 'id_siswa';

    protected $fillable = [
        'nama_lengkap',
        'nisn',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'no_telepon',
        'email',
        'agama',
        'kelas_id',
        'id_user'
    ];

    public $timestamps = false;

    
    public function class()
    {
        return $this->belongsTo(Classes::class, 'kelas_id');
    }
    public function Absensi()
    {
        return $this->hasMany(Absensi::class, 'id_siswa');
    }
}
