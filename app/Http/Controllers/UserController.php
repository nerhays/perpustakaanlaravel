<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\JenisUser;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('jenisUser')->where('delete_mark', '0')->get();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $jenisUsers = JenisUser::all();
        return view('users.create', compact('jenisUsers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_user' => 'required',
            'username' => 'required|unique:user,username',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'id_jenis_user' => 'required',
        ]);

        User::create([
            'nama_user' => $request->nama_user,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'id_jenis_user' => $request->id_jenis_user,
            'status_user' => 'active',
            'create_by' => auth()->user()->username,
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function edit($id_user)
    {
        $user = User::findOrFail($id_user);
        $jenisUsers = JenisUser::all();
        return view('users.edit', compact('user', 'jenisUsers'));
    }

    public function update(Request $request, $id_user)
    {
        $request->validate([
            'nama_user' => 'required',
            'username' => 'required|unique:user,username,'.$id_user. ',id_user',
            'email' => 'required|email',
            'id_jenis_user' => 'required',
        ]);

        $user = User::findOrFail($id_user);
        $user->update([
            'nama_user' => $request->nama_user,
            'username' => $request->username,
            'email' => $request->email,
            'id_jenis_user' => $request->id_jenis_user,
            'status_user' => $request->status_user,
            'update_by' => auth()->user()->username,
        ]);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy($id_user)
{
    $user = User::findOrFail($id_user);
    $user->delete();

    return response()->json(['success' => true]);
}

}
