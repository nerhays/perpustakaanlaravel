<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;
    protected $table = 'buku';
    protected $primaryKey = 'idbuku';
    protected $fillable = ['kode', 'judul', 'pengarang', 'idkategori', 'status_buku'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'idkategori');
    }
    public function peminjamans()
{
    return $this->hasMany(Peminjaman::class, 'idbuku', 'idbuku');
}


}
