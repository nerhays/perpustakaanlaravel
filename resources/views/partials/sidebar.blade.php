@php
    $menus = \App\Models\SettingMenuUser::with('menu')
        ->where('id_jenis_user', auth()->user()->id_jenis_user)
        ->get();
@endphp

<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    @foreach($menus as $setting)
    @if($setting->menu->parent_id === null)
    <li class="nav-item"> 
      <a href="{{ route($setting->menu->menu_link) }}" class="nav-link">
        <i class="{{ $setting->menu->menu_icon }} menu-icon"></i>
        <span>{{ $setting->menu->menu_name }}</span>
      </a>
    </li>
    @endif
    @endforeach
  </ul>
</nav>