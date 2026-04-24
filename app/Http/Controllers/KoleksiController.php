<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KoleksiController extends Controller
{
    public function index()
    {
        $alats = Alat::where('stok', '>', 0)->get();
        return view('koleksi.index', compact('alats'));
    }

    public function pinjam(Request $request)
    {
        $request->validate([
            'alat_id'         => 'required|exists:alats,id',
            'tanggal_kembali' => 'required|date|after:today',
        ]);

        $alat = Alat::findOrFail($request->alat_id);

        if ($alat->stok <= 0) {
            return back()->with('error', 'Stok alat tidak tersedia.');
        }

        $aktif = Peminjaman::where('user_id', Auth::id())
                    ->where('alat_id', $alat->id)
                    ->where('status', 'dipinjam')
                    ->exists();

        if ($aktif) {
            return back()->with('error', 'Anda masih meminjam alat ini.');
        }

        Peminjaman::create([
            'user_id'         => Auth::id(),
            'alat_id'         => $alat->id,
            'tanggal_pinjam'  => now(),
            'tanggal_kembali' => $request->tanggal_kembali,
            'status'          => 'dipinjam',
        ]);

        $alat->decrement('stok');

        return redirect()->route('riwayat.index')
                         ->with('success', 'Berhasil meminjam alat "' . $alat->nama_alat . '"!');
    }
}