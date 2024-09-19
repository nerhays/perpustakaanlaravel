@extends('admin.index')
@section('title', 'Manage User')
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/example.css') }}">
@endsection

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
        e.preventDefault();
        let userId = $(this).data('id');
        let url = '/users/' + userId;
        let row = $(this).closest('tr');

        if (confirm('Are you sure you want to delete this user?')) {
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
                        alert('User deleted successfully.');
                    } else {
                        alert('Failed to delete user. Please try again.');
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