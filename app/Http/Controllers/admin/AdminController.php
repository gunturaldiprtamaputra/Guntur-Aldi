<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\User;
use App\Models\Peminjaman;

class AdminController extends Controller
{
    public function index()
    {
        $alats = Alat::all();
        $anggota = User::where('role', 'user')->get(); // user biasa = anggota
        $peminjaman = Peminjaman::all();

        return view('admin.dashboard', compact('alats', 'anggota', 'peminjaman'));
    }
}