<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class UserWeb extends Model
{ 
    
    protected $table = 'user_web';

    protected $primaryKey = 'id_user';

    protected $fillable = [
        'username',
        'password',
        'email',
        'role',
        'no_telepon',
        'alamat',
        'created_at',
        'updated_at',
        'last_login',
        'image'
    ];
    public function setNoTeleponAttribute($value)
    {
        $this->attributes['no_telepon'] = $value ?: '1234567890'; // Default value
    }
    public static function getEnumValues($column)
    {
        $type = DB::select(DB::raw("SHOW COLUMNS FROM user_web WHERE Field = '{$column}'"))[0]->Type;
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $enum = array();
        foreach(explode(',', $matches[1]) as $value) {
            $v = trim($value, "'");
            $enum[] = $v;
        }
        return $enum;
    }
    use HasFactory;

    public function teachers()
    {
        return $this->hasMany(Teacher::class);
    }
    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'id_user');
    }
}
