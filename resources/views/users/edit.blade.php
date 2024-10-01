@extends('admin.index')
@section('title', 'Edit User')
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/example.css') }}">
@endsection

@section('content')
<div class="container">
    <h2>Edit User</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.update', $user->id_user) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nama_user">Name</label>
            <input type="text" class="form-control" name="nama_user" value="{{ old('nama_user', $user->nama_user) }}" required>
        </div>

        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username" value="{{ old('username', $user->username) }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}" required>
        </div>

        <div class="form-group">
            <label for="id_jenis_user">Role</label>
            <select name="id_jenis_user" class="form-control" required>
                @foreach ($jenisUsers as $jenis)
                    <option value="{{ $jenis->id_jenis_user }}" {{ $user->id_jenis_user == $jenis->id_jenis_user ? 'selected' : '' }}>{{ $jenis->jenis_user }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="password">Password (Kosongkan jika tidak ingin mengubah)</label>
            <input type="password" class="form-control" name="password">
        </div>

        <div class="form-group">
            <label for="status_user">Status</label>
            <select name="status_user" class="form-control" required>
                <option value="active" {{ $user->status_user == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ $user->status_user == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/example.js') }}"></script>
@endsection