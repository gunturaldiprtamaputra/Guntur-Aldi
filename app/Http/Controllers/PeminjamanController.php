<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Alat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjaman = Peminjaman::with(['user', 'alat'])->latest()->get();
        return view('peminjaman.index', compact('peminjaman'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'alat_id' => 'required|exists:alats,id',
        ]);

        $alat = Alat::findOrFail($request->alat_id);

        if ($alat->stok < 1) {
            return back()->with('error', 'Stok alat tidak tersedia!');
        }

        Peminjaman::create([
            'user_id' => Auth::id(),
            'alat_id' => $request->alat_id,
            'status'  => 'dipinjam',
        ]);

        $alat->decrement('stok');

        return redirect()->route('user.peminjaman')->with('success', 'Peminjaman berhasil!');
    }

    public function kembali(Peminjaman $peminjaman)
    {
        $peminjaman->update(['status' => 'dikembalikan']);
        $peminjaman->alat->increment('stok');

        return redirect()->back()->with('success', 'Alat berhasil dikembalikan!');
    }
}