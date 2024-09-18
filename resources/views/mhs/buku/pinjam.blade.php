@extends('mhs.index')

@section('content')
<div class="container">
    <h1>Pinjam Buku</h1>

    <form action="{{ route('mahasiswa.buku.pinjam.store') }}" method="POST">
        @csrf
        <input type="hidden" name="idbuku" value="{{ $buku->idbuku }}">
        <div class="form-group">
            <label for="id_user">ID User</label>
            <input type="text" id="id_user" name="id_user" class="form-control" value="{{ auth()->user()->id_user }}" readonly>
        </div>
        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" id="nama" name="nama" class="form-control" value="{{ auth()->user()->nama_user }}" readonly>
        </div>
        <div class="form-group">
            <label for="tanggal_pinjam">Tanggal Pinjam</label>
            <input type="date" id="tanggal_pinjam" name="tanggal_pinjam" class="form-control" value="{{ old('tanggal_pinjam', now()->format('Y-m-d')) }}" required>
        </div>
        <div class="form-group">
            <label for="tanggal_kembali">Tanggal Kembali</label>
            <input type="text" id="tanggal_kembali" name="tanggal_kembali" class="form-control" value="{{ old('tanggal_kembali', now()->addDays(5)->format('Y-m-d')) }}" readonly>
        </div>
        <button type="submit" class="btn btn-primary">Pinjam</button>
    </form>

    <script>
        document.getElementById('tanggal_pinjam').addEventListener('change', function() {
            var tanggalPinjam = new Date(this.value);
            var tanggalKembali = new Date(tanggalPinjam.setDate(tanggalPinjam.getDate() + 5));
            var formattedDate = tanggalKembali.toISOString().split('T')[0];
            document.getElementById('tanggal_kembali').value = formattedDate;
        });
    </script>
</div>
@endsection
