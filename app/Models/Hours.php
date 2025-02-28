<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Hours extends Model
{
    use HasFactory;    

    protected $table = 'jam_mata_pelajaran';

    protected $primaryKey = 'id_jam';

    protected $fillable = [        
        'id_jadwal',
        'hari',
        'jam',
        'jam_mulai',
        'jam_selesai',
        'updated_at',
        'created_at'
    ];
    public static function getEnumValues($column)
    {
        $instance = new static;
        $type = DB::select(DB::raw("SHOW COLUMNS FROM {$instance->getTable()} WHERE Field = '{$column}'"))[0]->Type;
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $enum = array();
        foreach (explode(',', $matches[1]) as $value) {
            $enum[] = trim($value, "'");
        }
        return $enum;
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'kelas_id');
    }
}
