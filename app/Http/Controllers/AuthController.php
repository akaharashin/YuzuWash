<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    function loginPage()
    {
        return view('auth.login');
    }

    function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        Auth::attempt($credentials);
        $user = Auth::user();
        if ($user->role == 'cashier') {
            return redirect()->route('cashierDashboard');
        } else if ($user->role == 'admin') {
            return redirect()->route('admin');
        } else {
            return redirect()->route('owner');
        }
    }

    function logout() {
        auth()->logout();
        return redirect()->route('loginPage');
    }
}
