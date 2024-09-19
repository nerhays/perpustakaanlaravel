@extends('admin.index')
@section('title', 'Manage Jenis User')
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
    <h2>Manage Jenis Users</h2>
    <a href="{{ route('jenisuser.create') }}" class="btn btn-primary mb-3">Add New Role</a>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jenisusers as $jenisuser)
                <tr>
                    <td>{{ $jenisuser->id_jenis_user }}</td>
                    <td>{{ $jenisuser->jenis_user }}</td>
                    <td>
                        <a href="{{ route('jenisuser.edit', $jenisuser->id_jenis_user) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('jenisuser.destroy', $jenisuser->id_jenis_user) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger delete-btn" data-id="{{ $jenisuser->id_jenis_user }}">Delete</button>
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
        let jenisuserId = $(this).data('id');
        let url = '/jenisuser/' + jenisuserId;
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