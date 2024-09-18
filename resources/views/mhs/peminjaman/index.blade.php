@extends('mhs.index')

@section('content')
<div class="container">
    <h1>Riwayat Peminjaman</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Kode Buku</th>
                <th>Judul Buku</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($peminjamans as $peminjaman)
            <tr>
                <td>{{ $peminjaman->buku->kode }}</td>
                <td>{{ $peminjaman->buku->judul }}</td>
                <td>{{ $peminjaman->tanggal_pinjam->format('d-m-Y') }}</td>
                <td>{{ $peminjaman->tanggal_kembali ? $peminjaman->tanggal_kembali->format('d-m-Y') : 'Belum Dikembalikan' }}</td>
                <td>{{ $peminjaman->status }}</td>
                <td>
                    @if ($peminjaman->status == 'menunggu_verifikasi')
                        <button class="btn btn-secondary" disabled>Menunggu Verifikasi</button>
                    @elseif ($peminjaman->status == 'dikembalikan')
                        <button class="btn btn-secondary" disabled>Dikembalikan</button>
                    @else
                        <form action="{{ route('mahasiswa.peminjaman.kembalikan', $peminjaman->idpeminjaman) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">Kembalikan</button>
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
