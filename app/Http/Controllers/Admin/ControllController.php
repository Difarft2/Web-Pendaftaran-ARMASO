<?php

namespace App\Http\Controllers\Admin;

use App\Models\Mode;
use App\Models\User;
use App\Models\Tagihan;
use App\Models\DataDiri;
use Illuminate\Http\Request;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ControllController extends Controller
{
    public function toggleMaintenance()
    {
        $new = Mode::getValue('maintenance_mode') === 'on' ? 'off' : 'on';
        Mode::setValue('maintenance_mode', $new);
        return redirect()->back()->with('status', "Maintenance mode: $new");
    }

    public function toggleRegistration()
    {
        $new = Mode::getValue('registration_closed') === 'on' ? 'off' : 'on';
        Mode::setValue('registration_closed', $new);
        return redirect()->back()->with('status', "Mode pendaftaran: $new");
    }

    public function toggleResetData(Request $request)
    {
        $request->validate([
            'password' => 'required',
        ]);

        $admin = Auth::guard('admin')->user();

        if (!Hash::check($request->password, $admin->password)) {
            return back()->with('error', 'Password salah');
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        datadiri::truncate();
        tagihan::truncate();
        PasswordReset::truncate();
        User::truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        return redirect()->back()->with('success', 'Semua data dari Peserta dan Tagihan berhasil dihapus.');
    }
}
