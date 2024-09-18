<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;
    protected $table = 'peminjaman';
    protected $primaryKey = 'idpeminjaman';
    public $timestamps = false;

    protected $fillable = [
        'id_user',        
        'idbuku',         
        'tanggal_pinjam', 
        'tanggal_kembali',
        'status'          
    ];
    protected $casts = [
        'tanggal_pinjam' => 'datetime',
        'tanggal_kembali' => 'datetime',
    ];

    public function buku()
{
    return $this->belongsTo(Buku::class, 'idbuku', 'idbuku');
}


    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
