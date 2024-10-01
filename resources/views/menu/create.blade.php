@extends('admin.index')
@section('title', 'Create User')
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
    <h2>Add Menu</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('managemenu.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nama_user">Menu Id</label>
            <input type="text" class="form-control" name="menu_id" value="{{ old('menu_id') }}" required>
        </div>

        <div class="form-group">
            <label for="username">Menu Name</label>
            <input type="text" class="form-control" name="menu_name" value="{{ old('menu_name') }}" required>
        </div>
        <div class="form-group">
            <label for="username">Menu Link</label>
            <input type="text" class="form-control" name="menu_link" value="{{ old('menu_link') }}" required>
        </div>
        <div class="form-group">
            <label for="username">Menu Icon</label>
            <div class="input-group">
                <input type="text" class="form-control" name="menu_icon" id="menu_icon" value="{{ old('menu_icon') }}" readonly required>
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" id="iconPickerButton">Select Icon</button>
                </div>
            </div>
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
