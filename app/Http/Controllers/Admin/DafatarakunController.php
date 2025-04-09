<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class DafatarakunController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();
        $limit = $request->input('limit', 10);

        if ($request->has('q')) {
            $search = $request->q;
            $query->where('name', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%");
        }

        $users = $query->paginate($limit)->appends(['q' => $request->q, 'limit' => $limit]);

        // Jika request berasal dari AJAX, kembalikan JSON
        if ($request->ajax()) {
            return response()->json($users);
        }

        return view('admin.resetpassword.akun', compact('users', 'limit'));
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return redirect()->route('daftarakun.index')->with('success', 'Akun berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('daftarakun.index')->with('error', 'Terjadi kesalahan saat menghapus akun: ' . $e->getMessage());
        }
    }
}
