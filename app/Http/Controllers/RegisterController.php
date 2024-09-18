<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\User;

use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
    ]);
    

    $user = User::create([
        'nama_user' => $request->name,  
        'username' => $request->name,   
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'id_jenis_user' => 3,  
        'status_user' => 'active',
    ]);

    
    auth()->login($user);

    return redirect('/');
}
}
