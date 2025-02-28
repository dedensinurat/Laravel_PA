<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    use HasFactory;

    protected $table = 'prestasi';
    protected $primaryKey = 'id_prestasi';

    protected $fillable = [
        'siswa_id',
        'jenis_prestasi',
        'tingkat_prestasi',
        'tahun_prestasi',
        'deskripsi_prestasi',
        'foto_prestasi',
        'id_user'
    ];

    // Menyatakan bahwa model tidak menggunakan kolom updated_at dan created_at
    public $timestamps = false;

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id', 'id_siswa');
    }
}
