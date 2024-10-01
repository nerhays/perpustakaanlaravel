<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Buku;
use App\Models\Message;
use App\Models\MessageTo;
use App\Models\User;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjaman = Peminjaman::with('user', 'buku')->get();

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
            
            $this->kirimEmailMahasiswa($peminjaman, 'peminjaman');

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

        $this->kirimEmailMahasiswa($peminjaman, 'pengembalian');

        return redirect()->back()->with('success', 'Buku telah dikembalikan!');
    }

    return redirect()->back()->with('error', 'Data peminjaman tidak ditemukan atau buku sudah dikembalikan.');
}

private function kirimEmailMahasiswa($peminjaman, $tipe)
{
    $mahasiswa = User::find($peminjaman->id_user);
    $buku = Buku::find($peminjaman->idbuku);

    $subject = $tipe == 'peminjaman' ? 'Peminjaman Buku' : 'Pengembalian Buku';
    $text = $tipe == 'peminjaman' 
        ? "Buku $buku->judul berhasil dipinjam."
        : "Buku $buku->judul berhasil dikembalikan.";

    $message = Message::create([
        'sender' => auth()->user()->id_user,
        'subject' => $subject,
        'message_text' => $text,
        'message_status' => 'sent',
        'no_mk' => 1,
        'create_by' => auth()->id(),
    ]);

    MessageTo::create([
        'message_id' => $message->message_id,
        'to' => $mahasiswa->id_user,
        'create_by' => auth()->id(),
    ]);
}


}
