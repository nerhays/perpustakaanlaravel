@extends('penjaga.index')

@section('title', 'Edit Buku')

@section('content')
<div class="container">
    <h1>Edit Buku</h1>
    <form action="{{ route('buku.update', $buku->idbuku) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="kode" class="form-label">Kode</label>
            <input type="text" class="form-control" id="kode" name="kode" value="{{ $buku->kode }}" required>
        </div>
        <div class="mb-3">
            <label for="judul" class="form-label">Judul</label>
            <input type="text" class="form-control" id="judul" name="judul" value="{{ $buku->judul }}" required>
        </div>
        <div class="mb-3">
            <label for="pengarang" class="form-label">Pengarang</label>
            <input type="text" class="form-control" id="pengarang" name="pengarang" value="{{ $buku->pengarang }}" required>
        </div>
        <div class="mb-3">
            <label for="idkategori" class="form-label">Kategori</label>
            <select class="form-control" id="idkategori" name="idkategori" required>
                @foreach ($kategoris as $kategori)
                    <option value="{{ $kategori->idkategori }}" @if ($kategori->idkategori == $buku->idkategori) selected @endif>
                        {{ $kategori->nama_kategori }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
