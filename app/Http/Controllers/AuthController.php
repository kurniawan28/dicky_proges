<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controllers
{
    // 🟦 Tampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // 🟦 Proses login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.'
        ])->onlyInput('email');
    }

    // 🟦 Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    // 🟦 Tampilkan form register
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // 🟦 Proses register (langsung login)
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email'=> 'required|email|unique:users,email',
            'password'=> 'required|string|min:6|confirmed'
        ]);

        // Buat user baru
        $user = User::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=> Hash::make($request->password)
        ]);

        // 🔥 Langsung login setelah register
        Auth::login($user);

        // 🔁 Redirect langsung ke dashboard
        return redirect()->route('dashboard')->with('success', 'Akun berhasil dibuat dan Anda sudah login!');
    }
}
