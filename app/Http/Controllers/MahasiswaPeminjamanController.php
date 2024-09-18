<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Buku;

class MahasiswaPeminjamanController extends Controller
{
    public function index()
{
    $peminjamans = Peminjaman::with('buku')
        ->where('id_user', auth()->user()->id_user)
        ->get();

    return view('mhs.peminjaman.index', compact('peminjamans'));
}


    public function kembalikan($idpeminjaman)
    {
        $peminjaman = Peminjaman::findOrFail($idpeminjaman);

        if ($peminjaman->status !== 'dikembalikan') {
            $peminjaman->update([
                'status' => 'menunggu_verifikasi',
                'tanggal_kembali' => now(),
            ]);
            Buku::where('idbuku', $peminjaman->idbuku)->update(['status_buku' => '1']);
    
            return redirect()->back()->with('success', 'Permintaan pengembalian buku telah diajukan.');
        }

        return redirect()->back()->with('success', 'Buku berhasil dikembalikan.');
    }
}
