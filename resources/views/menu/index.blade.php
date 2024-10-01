@extends('admin.index')
@section('title', 'Manage Menu')
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
    <h2>Manage Menu</h2>
    <a href="{{ route('managemenu.create') }}" class="btn btn-primary mb-3">Add New Menu</a>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Menu ID</th>
                <th>Menu Name</th>
                <th>Menu Link</th>
                <th>Menu Icon</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($menu as $menu)
                <tr>
                    <td>{{ $menu->menu_id }}</td>
                    <td>{{ $menu->menu_name }}</td>
                    <td>{{ $menu->menu_link }}</td>
                    <td>{{ $menu->menu_icon }}</td>
                    <td>
                        <a href="{{ route('managemenu.edit', $menu->menu_id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('managemenu.destroy', $menu->menu_id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger delete-btn" data-id="{{ $menu->menu_id }}">Delete</button>
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
        let menu_id = $(this).data('id');
        let url = '/managemenu/' + menu_id;
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