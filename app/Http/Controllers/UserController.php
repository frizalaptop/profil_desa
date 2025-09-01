<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function promote(User $user)
    {
        // Hanya role admin yang bisa mengakses
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        // Validasi bahwa user target bukan diri sendiri
        if ($user->id === Auth::id()) {
            return back()->with('error', 'Anda tidak bisa mengubah role diri sendiri.');
        }

        // Ubah role user target menjadi admin
        $user->update(['role' => 'admin']);

        return back()->with('success', 'Role user berhasil diubah menjadi Admin.');
    }

    public function demote(User $user)
    {
        // Hanya role admin yang bisa mengakses
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        // Validasi bahwa user target bukan diri sendiri
        if ($user->id === Auth::id()) {
            return back()->with('error', 'Anda tidak bisa mengubah role diri sendiri.');
        }

        if ($user->role === "kkndesaciangir19@gmail.com") {
            return back()->with('error', 'Akun pemeliharaan tidak dapat diubah.');
        }

        // Ubah role user target menjadi admin
        $user->update(['role' => 'user']);

        return back()->with('success', 'Role user berhasil diubah menjadi user.');
    }
}