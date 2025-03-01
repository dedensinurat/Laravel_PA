<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengunjung extends Model
{
    use HasFactory;

    protected $table = 'pengunjung';

    protected $primaryKey = 'id_pengunjung';

    protected $fillable = [
        'nama_pengunjung',
        'email',
        'tanggal',
        'created_at',
        'updated_at',
    ];


    public function inboxes()
    {
        return $this->hasMany(Inbox::class, 'id_pengunjung');
    }
}
