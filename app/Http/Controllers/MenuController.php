<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    public function index()
    {
        $menu = Menu::all();
        return view('menu.index', compact('menu'));
    }

    public function create()
    {
        return view('menu.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|unique:menu,menu_id',
            'menu_name' => 'required',
            'menu_link' => 'required',
        ]);

        Menu::create([
            'menu_id' => $request->menu_id,
            'menu_name' => $request->menu_name,
            'menu_link' => $request->menu_link,
            'menu_icon' => $request->menu_icon,
            'create_by' => auth()->user()->username,
        ]);

        return redirect()->route('managemenu.index')->with('success', 'Menu created successfully.');
    }

    public function edit($menu_id)
    {
        $menu = Menu::findOrFail($menu_id);
        return view('menu.edit', compact('menu'));
    }

    public function update(Request $request, $menu_id)
    {
        $request->validate([
            'menu_id' => 'required|unique:menu,menu_id,' . $menu_id . ',menu_id',
            'menu_name' => 'required',
            'menu_link' => 'required',
        ]);

        $menu_id = Menu::findOrFail($menu_id);
        $menu_id->update([
            'menu_id' => $request->menu_id,
            'menu_name' => $request->menu_name,
            'menu_link' => $request->menu_link,
            'menu_icon' => $request->menu_icon,
            'update_by' => auth()->user()->username,
        ]);

        return redirect()->route('managemenu.index')->with('success', 'Menu updated successfully.');
    }

    public function destroy($menu_id)
    {
        $menu = Menu::findOrFail($menu_id);
        $menu->delete();
        return response()->json(['success' => true]);
    }
}
