@extends('penjaga.index')

@section('title', 'Buku Management')

@section('content')
<style>
    #loader {
    position: fixed;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999;
}

.spinner-border {
    width: 3rem;
    height: 3rem;
}

</style>
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
                        <button type="button" class="btn btn-danger delete-btn" data-id="{{ $buku->idbuku }}">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('scripts')
    <script> 
       $(document).ready(function(){
        $('.delete-btn').on('click', function(e){
            e.preventDefault();
            let bukuId = $(this).data('id'); 
            let url = '/buku/' + bukuId; 
            let row = $(this).closest('tr');

            if (confirm('Are you sure you want to delete this book?')) { 
                $('#loader').show(); 

                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response){
                        $('#loader').hide(); 
                        if(response.success) {
                            row.fadeOut('slow', function(){
                                $(this).remove();
                            });
                            alert('Book deleted successfully.');
                        } else {
                            alert('Failed to delete book. Please try again.');
                        }
                    },
                    error: function(xhr){
                        $('#loader').hide(); 
                        alert('Something went wrong. Please try again.');
                    }
                });
            }
        });
    });



    </script>
    
@endsection