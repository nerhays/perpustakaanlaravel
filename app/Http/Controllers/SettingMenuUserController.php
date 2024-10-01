<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SettingMenuUser;
use App\Models\Menu;
use App\Models\JenisUser;

class SettingMenuUserController extends Controller
{
    public function index()
    {
        $settingmenu = SettingMenuUser::with(['menu', 'jenisUser'])->get();
        return view('settingmenu.index', compact('settingmenu'));
    }

    public function create()
    {
        $menus = Menu::all();
        $jenisUsers = JenisUser::all();
        return view('settingmenu.create', compact('menus', 'jenisUsers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_setting' => 'required|unique:setting_menu_user,no_setting',
        ]);

        SettingMenuUser::create([
            'no_setting' => $request->no_setting,
            'id_jenis_user' => $request->id_jenis_user,
            'menu_id' => $request->menu_id,
            'create_by' => auth()->user()->username,
        ]);

        return redirect()->route('settingmenu.index')->with('success', 'Menu created successfully.');
    }

    public function edit($no_setting)
    {
        $settingmenu = SettingMenuUser::findOrFail($no_setting);
        $menus = Menu::all();
        $jenisUsers = JenisUser::all();
        return view('settingmenu.edit', compact('settingmenu', 'menus', 'jenisUsers'));
    }

    public function update(Request $request, $no_setting)
    {
        $request->validate([
            'no_setting' => 'required|unique:setting_menu_user,no_setting,' . $no_setting . ',no_setting',
            
        ]);

        $no_setting = SettingMenuUser::findOrFail($no_setting);
        $no_setting->update([
            'no_setting' => $request->no_setting,
            'id_jenis_user' => $request->id_jenis_user,
            'menu_id' => $request->menu_id,
            'update_by' => auth()->user()->username,
        ]);

        return redirect()->route('settingmenu.index')->with('success', 'Menu updated successfully.');
    }

    public function destroy($no_setting)
    {
        $settingmenu = SettingMenuUser::findOrFail($no_setting);
        $settingmenu->delete();
        return response()->json(['success' => true]);
    }
}
