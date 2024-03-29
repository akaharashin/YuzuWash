<?php

namespace App\Http\Controllers;

use App\Models\Log;
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
        

        if(!Auth::attempt($credentials)){
            return redirect()->back()->with('message', 'Nama Pengguna atau Kata Sandi salah!');
        }
        $user = Auth::user();
        if ($user->role == 'cashier') {
            Log::create([
                'user_id' => auth()->user()->id,
                'activity' => 'telah melakukan login'
            ]);
            return redirect()->route('cashierDashboard')->with('message', 'Selamat datang ' . $user->name);
        } else if ($user->role == 'admin') {
            Log::create([
                'user_id' => auth()->user()->id,
                'activity' => 'telah melakukan login'
            ]);
            return redirect()->route('admin')->with('message', 'Selamat datang ' . $user->name);
        } else {
            return redirect()->route('report')->with('message', 'Selamat datang ' . $user->name);
        }
    }

    function logout() {
        auth()->logout();
        return redirect()->route('loginPage')->with('logout', 'Keluar berhasil, sampai ketemu lagi!');
    }
}
