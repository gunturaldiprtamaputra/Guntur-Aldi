<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Redirect admin ke dashboard admin
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        // Dashboard untuk user/anggota biasa
        $peminjaman = Peminjaman::where('user_id', $user->id)->latest()->get();

        $totalPinjam     = $peminjaman->count();
        $sedangDipinjam  = $peminjaman->whereIn('status', ['dipinjam', 'menunggu'])->count();
        $sudahKembali    = $peminjaman->where('status', 'dikembalikan')->count();
        $riwayatTerbaru  = $peminjaman->take(5);

        return view('user.dashboard', compact(
            'totalPinjam',
            'sedangDipinjam',
            'sudahKembali',
            'riwayatTerbaru'
        ));
    }
}