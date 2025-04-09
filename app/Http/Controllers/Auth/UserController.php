<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function register()
    {
        return view('auth.registerPeserta');
    }

    public function registerPost(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:50|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        // Membuat user baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Response untuk AJAX
        return response()->json([
            'success' => true,
            'message' => 'Registrasi berhasil! Akun Anda telah dibuat.',
            'data' => [
                'name' => $user->name,
                'email' => $user->email,
            ],
        ]);
    }

    public function login()
    {
        return view('auth.loginPeserta');
    }

    public function loginPost(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        // Credentials
        $credentials = $request->only('email', 'password');

        $remember = $request->has('remember');
        if (Auth::attempt($credentials, $remember)) {
            // Response untuk AJAX jika berhasil login
            return response()->json([
                'success' => true,
                'message' => 'Login berhasil!',
                'redirect' => url('/home'),
            ]);
        }

        // Response untuk AJAX jika gagal login
        return response()->json([
            'success' => false,
            'message' => 'Email atau password salah.',
        ], 401);
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('auth.login')->with('success', 'Anda berhasil logout.');
    }

    public function profil()
    {
        $user = Auth::user();
        return view('peserta.profil', compact('user'));
    }
}