<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KegiatanSiswa extends Model
{
    use HasFactory;

    protected $table = 'kegiatan_siswa';
    protected $primaryKey = 'id_kegiatan'; // Nama tabel yang sesuai dengan migration
    
    protected $fillable = [
        'judul_kegiatan',
        'isi_kegiatan',
        'tanggal_kegiatan',
        'waktu_kegiatan',
        'tempat_kegiatan',
        'foto_kegiatan',
        'kategori_kegiatan',
        'id_user',
    ];

    // Tambahkan relasi ke User jika diperlukan
    public function user()
    {
        return $this->belongsTo(UserWeb::class, 'id_user');
    }
}
