<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Buku;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjaman = Peminjaman::with('user', 'buku')
                     ->where('is_verified', false)
                     ->orWhere('status', 'menunggu_verifikasi')
                     ->get();

        return view('penjaga.peminjaman', compact('peminjaman'));
    }

    public function verifikasiPeminjaman($id)
    {
        $peminjaman = Peminjaman::find($id);
        
        if ($peminjaman) {
            $peminjaman->is_verified = true;
            $peminjaman->status = 'dipinjam';
            $peminjaman->save();

            $buku = Buku::find($peminjaman->idbuku);
            $buku->status_buku = '0';
            $buku->save();
            

            return redirect()->back()->with('success', 'Peminjaman telah diverifikasi!');
        }

        return redirect()->back()->with('error', 'Peminjaman tidak ditemukan!');
    }

    public function verifikasiPengembalian($id)
{
    $peminjaman = Peminjaman::find($id);

    if ($peminjaman && $peminjaman->status == 'menunggu_verifikasi') {
        $peminjaman->status = 'dikembalikan';
        $peminjaman->tanggal_kembali = now();
        $peminjaman->save();

        $buku = Buku::find($peminjaman->idbuku);
        $buku->status_buku = '1';
        $buku->save();

        return redirect()->back()->with('success', 'Buku telah dikembalikan!');
    }

    return redirect()->back()->with('error', 'Data peminjaman tidak ditemukan atau buku sudah dikembalikan.');
}
}
