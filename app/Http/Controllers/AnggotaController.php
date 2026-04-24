<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AnggotaController extends Controller
{
    public function index()
    {
        $anggota = User::latest()->get();
        return view('anggota.index', compact('anggota'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'role'     => 'required|in:admin,user',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        return redirect()->route('anggota.index')
                         ->with('success', 'Anggota berhasil ditambahkan!');
    }

    public function edit(User $anggota)
    {
        return view('anggota.edit', compact('anggota'));
    }

    public function update(Request $request, User $anggota)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $anggota->id,
            'role'  => 'required|in:admin,user',
        ]);

        $anggota->update([
            'name'  => $request->name,
            'email' => $request->email,
            'role'  => $request->role,
        ]);

        if ($request->filled('password')) {
            $anggota->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->route('anggota.index')
                         ->with('success', 'Data anggota berhasil diperbarui!');
    }

    public function destroy(User $anggota)
    {
        $anggota->delete();
        return redirect()->route('anggota.index')
                         ->with('success', 'Anggota berhasil dihapus!');
    }

    // Method yang tidak dipakai tapi wajib ada untuk resource
    public function create() { return redirect()->route('anggota.index'); }
    public function show(string $id) { return redirect()->route('anggota.index'); }
}