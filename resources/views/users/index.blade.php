@extends('admin.index')
@section('title', 'Manage User')
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/example.css') }}">
@endsection

@section('content')
<div class="container">
    <h2>Manage Users</h2>
    <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Add New User</a>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id_user }}</td>
                    <td>{{ $user->nama_user }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->jenisUser->jenis_user }}</td>
                    <td>{{ $user->status_user }}</td>
                    <td>
                        <a href="{{ route('users.edit', $user->id_user) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('users.destroy', $user->id_user) }}" method="POST" style="display:inline-block;">
    @csrf
    @method('DELETE')
    <button type="button" class="btn btn-danger delete-btn" data-id="{{ $user->id_user }}">Delete</button>
</form>


                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/example.js') }}"></script>
    <script> 
        $(document).ready(function(){
    $('.delete-btn').on('click', function(e){
        e.preventDefault();  // Mencegah tombol form submit biasa
        let userId = $(this).data('id');  // Mengambil id_user dari tombol
        let url = '/users/' + userId;     // Membuat URL untuk menghapus user berdasarkan id_user
        let row = $(this).closest('tr');  // Menyimpan baris (tr) yang akan dihapus
        
        if (confirm('Are you sure?')) {
            $.ajax({
                url: url, // Mengarahkan ke route yang sesuai
                type: 'DELETE', // Tipe request
                data: {
                    _token: $('input[name="_token"]').val()  // Mengirimkan CSRF token
                },
                success: function(response){
                    if(response.success) {
                        // Hapus baris dengan efek fadeOut
                        row.fadeOut('slow', function(){
                            $(this).remove();
                        });
                        alert('User deleted successfully.');
                    }
                },
                error: function(xhr){
                    alert('Something went wrong. Please try again.');
                }
            });
        }
    });
});


    </script>
@endsection