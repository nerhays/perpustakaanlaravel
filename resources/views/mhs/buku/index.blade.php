@extends('mhs.index')

@section('content')
<div class="container">
    <h1>Daftar Buku</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Judul</th>
                <th>Pengarang</th>
                <th>Kategori</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bukus as $buku)
            <tr>
                <td>{{ $buku->kode }}</td>
                <td>{{ $buku->judul }}</td>
                <td>{{ $buku->pengarang }}</td>
                <td>{{ $buku->kategori->nama_kategori }}</td>
                <td>{{ $buku->status_buku == '1' ? 'Tersedia' : 'Dipinjam' }}</td>
                <td>
                    @if ($buku->status_buku == '1')
                        <a href="{{ route('mahasiswa.buku.pinjam.form', $buku->idbuku) }}" class="btn btn-primary">Pinjam</a>
                    @else
                        <button class="btn btn-secondary" disabled>Dipinjam</button>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
