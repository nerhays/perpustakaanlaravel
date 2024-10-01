<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageTo extends Model
{
    use HasFactory;
    protected $table = 'message_to';
    protected $primaryKey = 'no_record';
    public $timestamps = false;

    protected $fillable = [
        'message_id',
        'to',
        'cc',
        'create_by',
        'update_by',
    ];

    public function message()
    {
        return $this->belongsTo(Message::class, 'message_id', 'message_id');
    }
    public function toUser()
    {
        return $this->belongsTo(User::class, 'to', 'id_user');
    }
}
