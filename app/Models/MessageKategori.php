<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageKategori extends Model
{
    use HasFactory;
    protected $table = 'message_kategori';
    protected $primaryKey = 'no_mk';
    public $timestamps = false;

    protected $fillable = [
        'description',
        'create_by',
        'update_by',
    ];

    public function messages()
    {
        return $this->hasMany(Message::class, 'no_mk', 'no_mk');
    }
}
