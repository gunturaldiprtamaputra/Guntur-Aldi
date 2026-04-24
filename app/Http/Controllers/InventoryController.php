<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory; // Memanggil model Inventory
use App\Models\Tool;      // Memanggil model Tool (karena kamu menggunakannya di kode)

class InventoryController extends Controller
{
    public function index()
    {
        // Jika kamu ingin menggunakan tabel Tool
        $items = Tool::all();
        return view('inventaris.index', compact('items'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $items = Tool::where('nama_alat', 'LIKE', "%$query%")->get();
        return view('inventaris.cari', compact('items'));
    }

    public function history()
    {
        // Gunakan \App\Models\peminjaman sesuai nama filemu yang huruf kecil
        $histories = \App\Models\peminjaman::with('inventory')->latest()->get();
        return view('inventaris.riwayat', compact('histories'));
    }
}