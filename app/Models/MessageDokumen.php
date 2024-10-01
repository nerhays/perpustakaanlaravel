<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageDokumen extends Model
{
    use HasFactory;
    protected $table = 'message_dokumen';
    protected $primaryKey = 'no_mdok';
    public $timestamps = false;

    protected $fillable = [
        'file',
        'description',
        'message_id',
        'create_by',
        'update_by',
    ];

    public function message()
    {
        return $this->belongsTo(Message::class, 'message_id', 'message_id');
    }
}
