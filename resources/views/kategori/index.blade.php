@extends('penjaga.index')

@section('title', 'Kategori Management')

@section('content')
<div class="container">
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <h1>Kategori</h1>
    <a href="{{ route('kategori.create') }}" class="btn btn-primary mb-3">Add Kategori</a>

    <h2>Daftar Kategori</h2>
    <table class="table table-striped mt-3">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kategori</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kategoris as $index => $kategori)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $kategori->nama_kategori }}</td>
                <td>
                    <a href="{{ route('kategori.edit', $kategori->idkategori) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('kategori.destroy', $kategori->idkategori) }}" method="POST" style="display:inline-block;">
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
