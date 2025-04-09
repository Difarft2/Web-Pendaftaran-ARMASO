<?php

namespace App\Http\Controllers\Auth;

use App\Models\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\URL;

class PasswordResetController extends Controller
{
    public function showRequestForm()
    {
        return view('auth.resetpassword.password_request');
    }

    public function requestReset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'phone' => 'required|numeric',
        ]);

        // Cek apakah email ada di tabel users
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'Email tidak terdaftar.');
        }

        // Buat token reset password
        $token = Str::random(60);

        PasswordReset::create([
            'email' => $request->email,
            'phone' => $request->phone,
            'token' => $token,
            'approved' => false,
        ]);

        return back()->with('success', true);
    }

    public function showAdminRequests(Request $request)
    {
        $limit = $request->input('limit', 10); // Default 10 data per halaman
        $search = $request->input('q', '');

        $requests = PasswordReset::where(function ($query) use ($search) {
            if ($search) {
                $query->where('email', 'LIKE', "%{$search}%")
                    ->orWhere('phone', 'LIKE', "%{$search}%");
            }
        })
            ->orderBy('created_at', 'desc')
            ->paginate($limit)
            ->appends(['limit' => $limit, 'q' => $search]);

        return view('admin.resetpassword.reset_requests', compact('requests', 'limit'));
    }


    public function approveReset($id)
    {
        $request = PasswordReset::findOrFail($id);
        $request->approved = true;

        // Buat link reset password dengan token
        $resetLink = URL::temporarySignedRoute(
            'password.reset.form',
            now()->addHours(24), // Link berlaku 24 jam
            ['token' => $request->token, 'email' => $request->email]
        );

        // Simpan link reset password di database
        $request->reset_link = $resetLink;
        $request->save();

        return back()->with('success', 'Reset password disetujui. Silahkan hubungi peserta.');
    }

    public function showResetForm($token)
    {
        return view('auth.resetpassword.reset_password', compact('token'));
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6|confirmed'
        ]);

        // Cari request reset yang valid
        $passwordReset = PasswordReset::where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$passwordReset) {
            return back()->withErrors(['email' => 'Token tidak valid atau sudah kadaluarsa.']);
        }

        // Update password user
        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        // Hapus request reset setelah selesai
        // $passwordReset->delete();

        return back()->with('success', true);
    }

    public function showakun()
    {
        $user = User::all();
        return view('admin.akun.index', compact('user'));
    }
}
