@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="fw-bold mb-4">⏳ Riwayat Pinjam</h2>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-0 overflow-hidden">
            <table class="table table-hover mb-0">
                <thead class="bg-dark text-white">
                    <tr>
                        <th class="ps-4 py-3">Peminjam</th>
                        <th class="py-3">Alat/Buku</th>
                        <th class="py-3">Tanggal Pinjam</th>
                        <th class="py-3">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($histories as $history)
                    <tr>
                        <td class="ps-4">{{ $history->user->name ?? 'User' }}</td>
                        <td>{{ $history->inventory->nama_alat ?? 'Data Hilang' }}</td>
                        <td>{{ $history->created_at->format('d M Y, H:i') }}</td>
                        <td>
                            @if($history->status == 'dikembalikan')
                                <span class="badge rounded-pill bg-success">Sudah Kembali</span>
                            @else
                                <span class="badge rounded-pill bg-warning text-dark">Masih Dipinjam</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-5 text-muted">Belum ada riwayat peminjaman.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection