@extends('admin.index')
@section('title', 'Edit Relasi')
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/example.css') }}">
@endsection

@section('content')
<style>#iconPickerModal {
    position: absolute;
    background-color: white;
    border: 1px solid #ddd;
    padding: 10px;
    max-height: 300px;
    overflow-y: scroll;
}

.icon-grid {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 10px;
}

.icon-grid i {
    font-size: 24px;
    cursor: pointer;
}
</style>
<div class="container">
    <h2>Edit Relasi</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('settingmenu.update', $settingmenu->no_setting) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nama_user">No Setting</label>
            <input type="text" class="form-control" name="no_setting" value="{{ old('no_setting', $settingmenu->no_setting) }}" required>
        </div>
        <div class="form-group">
            <label for="id_jenis_user">Jenis User</label>
            <select name="id_jenis_user" class="form-control" required>
                <option value="" disabled>Pilih Jenis User</option>
                @foreach($jenisUsers as $jenisUser)
                    <option value="{{ $jenisUser->id_jenis_user }}" {{ $settingmenu->id_jenis_user == $jenisUser->id_jenis_user ? 'selected' : '' }}>
                        {{ $jenisUser->jenis_user }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="menu_id">Menu</label>
            <select name="menu_id" class="form-control" required>
                <option value="" disabled>Pilih Menu</option>
                @foreach($menus as $menu)
                    <option value="{{ $menu->menu_id }}" {{ $settingmenu->menu_id == $menu->menu_id ? 'selected' : '' }}>
                        {{ $menu->menu_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <div id="iconPickerModal" style="display: none;">
    <div class="icon-grid">
        <i class="icon-grid" data-icon="icon-grid"></i>
        <i class="icon-head" data-icon="icon-head"></i>
        <i class="mdi mdi-account-convert" data-icon="mdi mdi-account-convert"></i>
        <i class="mdi mdi-checkbox-multiple-blank-outline" data-icon="mdi mdi-checkbox-multiple-blank-outline"></i>
        <i class="mdi mdi-access-point-network" data-icon="mdi mdi-access-point-network"></i>
        <i class="mdi mdi-book-plus" data-icon="mdi mdi-book-plus"></i>
        <i class="icon-paper" data-icon="icon-paper"></i>
        <i class="mdi mdi-account-box-outline" data-icon="mdi mdi-account-box-outline"></i>
        <i class="mdi mdi-apps" data-icon="mdi mdi-apps"></i>
    </div>
    </div>
</div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/example.js') }}"></script>
    <script>document.getElementById('iconPickerButton').addEventListener('click', function () {
    document.getElementById('iconPickerModal').style.display = 'block';
});

document.querySelectorAll('#iconPickerModal .icon-grid i').forEach(function (icon) {
    icon.addEventListener('click', function () {
        document.getElementById('menu_icon').value = this.getAttribute('data-icon');
        document.getElementById('iconPickerModal').style.display = 'none';
    });
});
</script>
@endsection
