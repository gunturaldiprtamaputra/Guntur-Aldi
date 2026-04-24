<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatController extends Controller
{
    public function index()
    {
        // Tampilkan riwayat peminjaman milik user yang login
        $riwayat = Peminjaman::with(['alat'])
                    ->where('user_id', Auth::id())
                    ->latest()
                    ->get();

        return view('riwayat.index', compact('riwayat'));
    }
}