@extends('penjaga.index')

@section('title', 'Buku Management')

@section('content')
<div class="container">
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <h1>Buku</h1>
    <a href="{{ route('buku.create') }}" class="btn btn-primary mb-3">Add Buku</a>

    <h2>Daftar Buku</h2>
    <table class="table table-striped mt-3">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Judul</th>
                <th>Pengarang</th>
                <th>Kategori</th>
                <th>Status Buku</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bukus as $buku)
            <tr>
                <td>{{ $buku->kode }}</td>
                <td>{{ $buku->judul }}</td>
                <td>{{ $buku->pengarang }}</td>
                <td>{{ $buku->kategori->nama_kategori }}</td>
                <td>{{ $buku->status_buku == 1 ? 'Tersedia' : 'Dipinjam' }}</td>
                <td>
                    <a href="{{ route('buku.edit', $buku->idbuku) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('buku.destroy', $buku->idbuku) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
