@extends('penjaga.index')

@section('title', 'Edit Kategori')

@section('content')
<div class="container">
    <h1>Edit Kategori</h1>
    <form action="{{ route('kategori.update', $kategori->idkategori) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nama_kategori" class="form-label">Nama Kategori</label>
            <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" value="{{ $kategori->nama_kategori }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
