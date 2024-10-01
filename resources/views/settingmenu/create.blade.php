@extends('admin.index')
@section('title', 'Create Relasi')
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/example.css') }}">
@endsection

@section('content')
<div class="container">
    <h2>Add Relasi</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('settingmenu.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nama_user">No Setting</label>
            <input type="text" class="form-control" name="no_setting" value="{{ old('no_setting') }}" required>
        </div>

        <div class="form-group">
            <label for="id_jenis_user">Jenis User</label>
            <select name="id_jenis_user" class="form-control" required>
                <option value="" disabled selected>Pilih Jenis User</option>
                @foreach($jenisUsers as $jenisUser)
                    <option value="{{ $jenisUser->id_jenis_user }}">{{$jenisUser->id_jenis_user}} - {{ $jenisUser->jenis_user }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="menu_id">Menu</label>
            <select name="menu_id" class="form-control" required>
                <option value="" disabled selected>Pilih Menu</option>
                @foreach($menus as $menu)
                    <option value="{{ $menu->menu_id }}">{{$menu->menu_id}} - {{ $menu->menu_name }}</option>
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
