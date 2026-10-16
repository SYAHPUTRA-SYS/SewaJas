<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Tampilkan halaman login
     */
    public function showLogin()
    {
        // Jika sudah login, redirect ke dashboard
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('auth.login');
    }

    /**
     * Proses login
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'password.required' => 'Password wajib diisi',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Cek apakah user adalah admin
            if (Auth::user()->role !== 'admin') {
                Auth::logout();
                return redirect()->route('login')
                        ->with('error', 'Anda tidak memiliki akses admin!');
            }

            $request->session()->regenerate();

            return redirect()->route('dashboard')
                    ->with('success', 'Selamat datang, ' . Auth::user()->name . '!');
        }

        return redirect()->back()
                ->with('error', 'Email atau password salah!')
                ->withInput($request->only('email'));
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
                ->with('success', 'Anda berhasil logout!');
    }
}
