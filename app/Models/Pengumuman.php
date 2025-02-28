<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    use HasFactory;

    protected $table = 'pengumuman';
    protected $primaryKey = 'id_pengumuman';

    protected $fillable = [
        'judul_pengumuman',
        'isi_pengumuman',
        'tanggal_pengumuman',
        'waktu_pengumuman',
        'penulis',
        'kategori_pengumuman',
        'img_pengumuman',
        'file_pengumuman',
        'id_user',        
    ];
    // Menyatakan bahwa model tidak menggunakan kolom updated_at dan created_at
    public $timestamps = false;
        
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id', 'id_siswa');
    }
}
