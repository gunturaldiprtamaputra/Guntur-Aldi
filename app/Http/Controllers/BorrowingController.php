<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman; 
use Illuminate\Support\Facades\Auth;

class BorrowingController extends Controller // <--- Baris ini WAJIB ada
{
    public function store(Request $request, $id)
    {
        // Logika menyimpan peminjaman
        Peminjaman::create([
            'user_id' => Auth::id(),
            'alat_id' => $id,
            'status' => 'dipinjam',
        ]);

        return back()->with('success', 'Alat berhasil dipinjam!');
    }
} // <--- Jangan lupa tutup kurung kurawal class di paling bawah