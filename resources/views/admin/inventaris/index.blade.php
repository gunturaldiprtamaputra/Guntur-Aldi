@extends('layouts.app') {{-- Sesuaikan dengan nama layout utama Anda --}}

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">📦 Inventaris Alat</h2>
        <button class="btn btn-primary shadow-sm">+ Tambah Alat</button>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Kode Alat</th>
                        <th>Nama Alat</th>
                        <th>Stok</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                    <tr>
                        <td><span class="badge bg-secondary">{{ $item->kode_alat }}</span></td>
                        <td>{{ $item->nama_alat }}</td>
                        <td>{{ $item->stok }} unit</td>
                        <td>
                            @if($item->stok > 0)
                                <span class="badge bg-success">Tersedia</span>
                            @else
                                <span class="badge bg-danger">Habis</span>
                            @endif
                        </td>
                        <td>
                            <button class="btn btn-sm btn-outline-info">Edit</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4">Data inventaris masih kosong.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection