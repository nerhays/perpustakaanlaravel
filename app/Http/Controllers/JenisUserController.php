<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisUser;

class JenisUserController extends Controller
{
    public function index()
    {
        $jenisusers = JenisUser::all();
        return view('jenisuser.index', compact('jenisusers'));
    }

    public function create()
    {
        return view('jenisuser.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_user' => 'required|unique:jenis_user,jenis_user',
        ]);

        JenisUser::create([
            'id_jenis_user' => $request->id_jenis_user,
            'jenis_user' => $request->jenis_user,
            'create_by' => auth()->user()->username,
        ]);

        return redirect()->route('jenisuser.index')->with('success', 'Jenis User created successfully.');
    }

    public function edit($id_jenis_user)
    {
        $jenisuser = JenisUser::findOrFail($id_jenis_user);
        return view('jenisuser.edit', compact('jenisuser'));
    }

    public function update(Request $request, $id_jenis_user)
    {
        $request->validate([
            'jenis_user' => 'required|unique:jenis_user,jenis_user,' . $id_jenis_user . ',id_jenis_user',
        ]);

        $jenisUser = JenisUser::findOrFail($id_jenis_user);
        $jenisUser->update([
            'id_jenis_user' => $request->id_jenis_user,
            'jenis_user' => $request->jenis_user,
            'update_by' => auth()->user()->username,
        ]);

        return redirect()->route('jenisuser.index')->with('success', 'Jenis User updated successfully.');
    }

    public function destroy($id_jenis_user)
    {
        $jenisUser = JenisUser::findOrFail($id_jenis_user);
        $jenisUser->delete();
        return response()->json(['success' => true]);
    }
}
