<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisUser extends Model
{
    use HasFactory;
    protected $table = 'jenis_user';
    protected $primaryKey = 'id_jenis_user';
    public $timestamps = true;

    protected $fillable = [
        'jenis_user', 'create_by', 'update_by', 'delete_mark'
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'id_jenis_user', 'id_jenis_user');
    }
}
