@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="fw-bold mb-4">🔍 Cari Koleksi</h2>

    <div class="card border-0 shadow-sm rounded-4 mb-4" style="background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(10px);">
        <div class="card-body p-4">
            <form action="{{ route('koleksi.cari') }}" method="GET">
                <div class="input-group input-group-lg">
                    <input type="text" name="query" class="form-control border-0 bg-light" placeholder="Ketik nama alat atau buku yang dicari..." value="{{ request('query') }}">
                    <button class="btn btn-primary px-4" type="submit">Cari</button>
                </div>
            </form>
        </div>
    </div>

    @if(isset($items))
    <div class="row">
        @forelse($items as $item)
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm h-100 rounded-4">
                <div class="card-body">
                    <h5 class="fw-bold">{{ $item->nama_alat }}</h5>
                    <p class="text-muted small">Kode: {{ $item->kode_alat }}</p>
                    <hr class="opacity-25">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="fw-bold text-primary">Stok: {{ $item->stok }}</span>
                        <a href="#" class="btn btn-sm btn-dark">Pinjam</a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="text-center mt-5">
            <img src="https://illustrations.popsy.co/gray/no-results.svg" alt="No Result" style="width: 200px;">
            <p class="text-muted mt-3">Koleksi tidak ditemukan.</p>
        </div>
        @endforelse
    </div>
    @endif
</div>
@endsection