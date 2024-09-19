@extends('penjaga.index')

@section('title', 'Kategori Management')

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
                        <button type="button" class="btn btn-danger delete-btn" data-id="{{ $kategori->idkategori }}">Delete</button>
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
            let kategoriId = $(this).data('id'); 
            let url = '/kategori/' + kategoriId; 
            let row = $(this).closest('tr');

            if (confirm('Are you sure you want to delete this category?')) { 
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
                            alert('Category deleted successfully.'); 
                        } else {
                            alert('Failed to delete category. Please try again.'); 
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
