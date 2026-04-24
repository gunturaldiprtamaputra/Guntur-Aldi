<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use Illuminate\Http\Request;

class AlatController extends Controller
{
  public function store(Request $request)
{
    $request->validate([
        'nama_alat' => 'required|string|max:255',
        'stok'      => 'required|integer|min:0',
        'kategori'  => 'required|string|max:255',
    ]);

    Alat::create([
        'nama_alat' => $request->nama_alat,
        'stok'      => $request->stok,
        'kategori'  => $request->kategori,
    ]);

    return redirect()->route('admin.dashboard')->with('success', 'Alat berhasil ditambahkan!');
}

public function update(Request $request, Alat $alat)
{
    $request->validate([
        'nama_alat' => 'required|string|max:255',
        'stok'      => 'required|integer|min:0',
        'kategori'  => 'required|string|max:255',
    ]);

    $alat->update([
        'nama_alat' => $request->nama_alat,
        'stok'      => $request->stok,
        'kategori'  => $request->kategori,
    ]);

    return redirect()->route('admin.dashboard')->with('success', 'Alat berhasil diupdate!');
}
}