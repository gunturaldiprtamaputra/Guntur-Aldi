<?php

namespace App\Http\Controllers\Auth; // Sesuaikan folder jika perlu

use App\Http\Controllers\Controller; // Untuk memanggil base Controller
use Illuminate\Http\Request;         // Untuk tipe data $request
use Illuminate\Support\Facades\Auth; // Jika butuh Auth (opsional)

class LoginController extends Controller
{
    // ... kode bawaan login lainnya (seperti trait AuthenticatesUsers) ...

    /**
     * Mengatur pengalihan halaman setelah login berhasil berdasarkan role.
     */
    protected function authenticated(Request $request, $user)
    {
        if ($user->role == 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('user.dashboard');
    }
} 
// Ini adalah penutup class