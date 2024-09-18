<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();

            if ($user->status_user === 'inactive') {
                Auth::logout();
                return back()->withInput($request->only('email'))->withErrors([
                    'email' => 'Your account is inactive. Please contact support.',
                ]);
            }
            switch ($user->id_jenis_user) {
                case 1:
                    return redirect('/dashboardadm');
                case 2:
                    return redirect('/dashboardpjg');
                case 3:
                    return redirect('/dashboardmhs');
                default:
                    return redirect('/');
            }
        }
    
        return back()->withInput($request->only('email'))->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
