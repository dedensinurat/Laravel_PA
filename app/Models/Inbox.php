<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inbox extends Model
{
    use HasFactory;

    protected $table = 'inbox';

    protected $primaryKey = 'id_inbox';

    protected $fillable = [
        'id_pengunjung',
        'tanggal',
        'subjek',
        'isi_pesan',        
        'status_inbox',
        'id_user',
        'created_at',
        'updated_at',
    ];

    public function pengunjung()
    {
        return $this->belongsTo(Pengunjung::class, 'id_pengunjung');
    }
}
