<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\Message;
use App\Models\MessageTo;
use App\Models\User;

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

    $peminjaman = Peminjaman::create([
        'id_user' => $user->id_user,
        'idbuku' => $request->idbuku,
        'tanggal_pinjam' => $tanggal_pinjam,
        'tanggal_kembali' => $tanggal_kembali,
        'status' => 'menunggu_verifikasi',
    ]);

    $buku->update(['status_buku' => '0']);
    
    $this->kirimEmailPenjaga($peminjaman);

    return redirect()->route('mahasiswa.peminjaman.index')->with('success', 'Buku berhasil dipinjam, menunggu verifikasi penjaga.');
}
private function kirimEmailPenjaga($peminjaman)
{
    $penjaga = User::where('id_jenis_user', '2')->first();
    $mahasiswa = User::find($peminjaman->id_user);
    $buku = Buku::find($peminjaman->idbuku);

    $subject = 'Peminjaman Buku';
    $text = "$mahasiswa->nama_user ingin meminjam buku $buku->judul.";

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
