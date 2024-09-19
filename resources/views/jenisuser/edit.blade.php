@extends('admin.index')
@section('title', 'Create User')
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/example.css') }}">
@endsection

@section('content')
<div class="container">
    <h2>Edit Role</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('jenisuser.update', $jenisuser->id_jenis_user) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nama_user">ID Jenis User</label>
            <input type="text" class="form-control" name="id_jenis_user" value="{{ old('id_jenis_user', $jenisuser->id_jenis_user) }}" required>
        </div>
        <div class="form-group">
            <label for="username">Jenis User</label>
            <input type="text" class="form-control" name="jenis_user" value="{{ old('jenis_user', $jenisuser->jenis_user) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/example.js') }}"></script>
@endsection
