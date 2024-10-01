<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Buku;use App\Models\Message;
use App\Models\MessageTo;
use App\Models\User;

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

            $this->kirimEmailPenjaga($peminjaman, 'pengembalian');
    
            return redirect()->back()->with('success', 'Permintaan pengembalian buku telah diajukan.');
        }

        return redirect()->back()->with('success', 'Buku berhasil dikembalikan.');
    }
    private function kirimEmailPenjaga($peminjaman, $tipe)
    {
        $penjaga = User::where('id_jenis_user', '2')->first();
        $mahasiswa = User::find($peminjaman->id_user);
        $buku = Buku::find($peminjaman->idbuku);

        $subject = $tipe == 'peminjaman' ? 'Peminjaman Buku' : 'Pengembalian Buku';
        $text = $tipe == 'peminjaman' 
            ? "$mahasiswa->nama_user ingin meminjam buku $buku->judul."
            : "$mahasiswa->nama_user ingin mengembalikan buku $buku->judul.";

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
            'to' => $penjaga->id_user,
            'create_by' => auth()->id(),
        ]);
    }
}
