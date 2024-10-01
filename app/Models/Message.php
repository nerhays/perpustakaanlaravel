<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $table = 'message';
    protected $primaryKey = 'message_id';
    public $timestamps = false;
    protected $casts = [
        'created_date' => 'datetime',
    ];
    protected $fillable = [
        'sender',
        'message_reference',
        'subject',
        'message_text',
        'message_status',
        'no_mk',
        'create_by',
        'update_by',
    ];

    public function senderUser()
    {
        return $this->belongsTo(User::class, 'sender', 'id_user');
    }

    public function kategori()
    {
        return $this->belongsTo(MessageKategori::class, 'no_mk', 'no_mk');
    }

    public function messageTo()
    {
        return $this->hasMany(MessageTo::class, 'message_id', 'message_id');
    }
    public function documents()
{
    return $this->hasMany(MessageDokumen::class, 'message_id', 'message_id');
}

    
}
