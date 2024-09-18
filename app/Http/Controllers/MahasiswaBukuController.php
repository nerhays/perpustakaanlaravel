<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Peminjaman;

class MahasiswaBukuController extends Controller
{
    public function index()
    {
        $bukus = Buku::with('kategori')->get();

        return view('mhs.buku.index', compact('bukus'));
    }

    public function pinjamForm($idbuku)
    {
        $buku = Buku::findOrFail($idbuku);

        if ($buku->status_buku == '0') {
            return redirect()->route('mahasiswa.buku.index')->with('error', 'Buku ini sedang dipinjam.');
        }

        return view('mhs.buku.pinjam', compact('buku'));
    }

    public function pinjamStore(Request $request)
{
    $user = auth()->user();

    if (!$user) {
        return redirect()->route('login.form')->with('error', 'Anda harus login untuk meminjam buku.');
    }

    $buku = Buku::findOrFail($request->idbuku);

    if ($buku->status_buku == '0') {
        return redirect()->route('mahasiswa.buku.index')->with('error', 'Buku ini sedang dipinjam.');
    }

    $tanggal_pinjam = $request->tanggal_pinjam;
    $tanggal_kembali = \Carbon\Carbon::parse($tanggal_pinjam)->addDays(5);

    Peminjaman::create([
        'id_user' => $user->id_user,
        'idbuku' => $request->idbuku,
        'tanggal_pinjam' => $tanggal_pinjam,
        'tanggal_kembali' => $tanggal_kembali,
        'status' => 'menunggu_verifikasi',
    ]);

    $buku->update(['status_buku' => '0']);

    return redirect()->route('mahasiswa.peminjaman.index')->with('success', 'Buku berhasil dipinjam, menunggu verifikasi penjaga.');
}



}
