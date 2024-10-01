@extends('penjaga.index')

@section('content')
<div class="container">
    <h1>Daftar Peminjaman</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Nama Peminjam</th>
                <th>Buku</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($peminjaman as $item)
            <tr>
                <td>{{ $item->user->nama_user }}</td>
                <td>{{ $item->buku->judul }}</td>
                <td>
                    @if ($item->status == 'menunggu_verifikasi')
                        <span class="badge badge-warning">Menunggu Verifikasi</span>
                    @elseif ($item->status == 'dipinjam')
                        <span class="badge badge-primary">Dipinjam</span>
                    @elseif ($item->status == 'dikembalikan')
                        <span class="badge badge-success">Dikembalikan</span>
                    @endif
                </td>
                <td>
                    <!-- Verifikasi peminjaman -->
                    @if(!$item->is_verified && $item->status == 'menunggu_verifikasi')
                    <form action="{{ route('verifikasi.peminjaman', $item->idpeminjaman) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success btn-sm">Verifikasi Peminjaman</button>
                    </form>
                    @endif

                    <!-- Verifikasi pengembalian -->
                    @if($item->is_verified && $item->status == 'menunggu_verifikasi')
                    <form action="{{ route('verifikasi.pengembalian', $item->idpeminjaman) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm">Verifikasi Pengembalian</button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
