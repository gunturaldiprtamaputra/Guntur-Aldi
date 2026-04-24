<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Alat</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light p-4">
<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold">🔧 Kelola Alat</h2>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.dashboard') }}"   class="btn btn-outline-secondary">← Dashboard</a>
            <a href="{{ route('admin.alat.create') }}" class="btn btn-primary">+ Tambah Alat</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Filter --}}
    <form method="GET" action="{{ route('admin.alat.index') }}" class="card p-3 mb-3 shadow-sm">
        <div class="row g-2">
            <div class="col-md-5">
                <input type="text" name="search" class="form-control"
                       placeholder="Cari nama / kategori..." value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <select name="kategori" class="form-select">
                    <option value="">Semua Kategori</option>
                    @foreach($kategoris as $kat)
                        <option value="{{ $kat }}" {{ request('kategori') == $kat ? 'selected' : '' }}>
                            {{ $kat }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 d-flex gap-1">
                <button class="btn btn-outline-secondary w-100">Filter</button>
                <a href="{{ route('admin.alat.index') }}" class="btn btn-outline-danger">✕</a>
            </div>
        </div>
    </form>

    <div class="card shadow-sm">
        <table class="table mb-0">
            <thead class="table-dark">
                <tr><th>#</th><th>Nama Alat</th><th>Kategori</th><th>Waktu Simpan</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                @forelse($alats as $i => $a)
                <tr>
                    <td>{{ $alats->firstItem() + $i }}</td>
                    <td>{{ $a->nama_alat }}</td>
                    <td><span class="badge bg-secondary">{{ $a->kategori }}</span></td>
                    <td>{{ $a->created_at->diffForHumans() }}</td>
                    <td>
                        <a href="{{ route('admin.alat.edit', $a->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.alat.destroy', $a->id) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Yakin hapus?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center text-muted py-3">Tidak ada data.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-3">{{ $alats->links() }}</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>