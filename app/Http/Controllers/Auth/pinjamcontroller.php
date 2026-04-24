<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PinjamController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'alat_id'        => 'required|exists:alats,id',
            'tanggal_pinjam' => 'required|date|after_or_equal:today',
        ]);

        $alat = Alat::findOrFail($request->alat_id);

        if ($alat->stok <= 0) {
            return back()->with('error', 'Stok alat tidak tersedia.');
        }

        // Cek peminjaman aktif yang sama
        $aktif = Peminjaman::where('user_id', Auth::id())
                    ->where('alat_id', $alat->id)
                    ->whereIn('status', ['dipinjam', 'menunggu'])
                    ->exists();

        if ($aktif) {
            return back()->with('error', 'Anda masih memiliki peminjaman aktif untuk alat ini.');
        }

        Peminjaman::create([
            'user_id'        => Auth::id(),
            'alat_id'        => $alat->id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali'=> null,
            'catatan'        => $request->catatan,
            'status'         => 'dipinjam',
        ]);

        $alat->decrement('stok');

        return back()->with('success', 'Berhasil mengajukan peminjaman "' . $alat->nama_alat . '"!');
    }
}