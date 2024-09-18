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
                <td>{{ $item->status }}</td>
                <td>
                    @if(!$item->is_verified && $item->status == 'menunggu_verifikasi')
                    <form action="{{ route('verifikasi.peminjaman', $item->idpeminjaman) }}" method="POST">
                        @csrf
                        <button type="submit">Verifikasi Peminjaman</button>
                    </form>
                    @endif

                    @if($item->status == 'menunggu_verifikasi')
                    <form action="{{ route('verifikasi.pengembalian', $item->idpeminjaman) }}" method="POST">
                        @csrf
                        <button type="submit">Verifikasi Pengembalian</button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
