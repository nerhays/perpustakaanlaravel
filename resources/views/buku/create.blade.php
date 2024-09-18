@extends('penjaga.index')

@section('title', 'Add Buku')

@section('content')
<div class="container">
    <h1>Add New Buku</h1>
    <form action="{{ route('buku.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="kode" class="form-label">Kode</label>
            <input type="text" class="form-control" id="kode" name="kode" required>
        </div>
        <div class="mb-3">
            <label for="judul" class="form-label">Judul</label>
            <input type="text" class="form-control" id="judul" name="judul" required>
        </div>
        <div class="mb-3">
            <label for="pengarang" class="form-label">Pengarang</label>
            <input type="text" class="form-control" id="pengarang" name="pengarang" required>
        </div>
        <div class="mb-3">
            <label for="idkategori" class="form-label">Kategori</label>
            <select class="form-control" id="idkategori" name="idkategori" required>
                @foreach ($kategoris as $kategori)
                    <option value="{{ $kategori->idkategori }}">{{ $kategori->nama_kategori }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
