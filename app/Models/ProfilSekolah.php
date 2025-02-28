<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilSekolah extends Model
{
    use HasFactory;
    protected $table = 'profil_sekolah';

    protected $primaryKey = 'id_profil';

    protected $fillable = [
        'nama_sekolah',
        'alamat_sekolah',
        'email_sekolah',
        'no_telepon_sekolah',
        'logo_sekolah',
        'visi_sekolah',
        'misi_sekolah',
        'sambutan_kepsek',
        'id_user'
    ];
    // public function getLogoSekolahAttribute($value)
    // {
    //     return $value ? 'storage/img/' . $value : 'storage/img/logoTutWuri.png';
    // }
}
