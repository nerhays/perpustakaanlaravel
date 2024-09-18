@extends('admin.index')
@section('title', 'Create User')
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/example.css') }}">
@endsection

@section('content')
<div class="container">
    <h2>Add New User</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nama_user">Name</label>
            <input type="text" class="form-control" name="nama_user" value="{{ old('nama_user') }}" required>
        </div>

        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username" value="{{ old('username') }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" required>
        </div>

        <div class="form-group">
            <label for="id_jenis_user">Role</label>
            <select name="id_jenis_user" class="form-control" required>
                @foreach ($jenisUsers as $jenis)
                    <option value="{{ $jenis->id_jenis_user }}">{{ $jenis->jenis_user }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/example.js') }}"></script>
@endsection
