<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Peminjaman</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light p-4">
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">📦 Kelola Peminjaman</h2>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">← Dashboard</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <table class="table mb-0">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Peminjam</th>
                    <th>Alat</th>
                    <th>Tgl Pinjam</th>
                    <th>Catatan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($peminjamans as $i => $p)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>
                        <strong>{{ $p->user->name }}</strong>
                        <div class="small text-muted">{{ $p->user->email }}</div>
                    </td>
                    <td>
                        {{ $p->alat->nama_alat }}
                        <div class="small text-muted">{{ $p->alat->kategori }}</div>
                    </td>
                    <td>{{ $p->tanggal_pinjam }}</td>
                    <td>{{ $p->catatan ?? '-' }}</td>
                    <td>
                        @php
                            $badge = match($p->status) {
                                'menunggu'    => 'warning',
                                'disetujui'   => 'success',
                                'ditolak'     => 'danger',
                                'dikembalikan'=> 'info',
                                default       => 'secondary'
                            };
                        @endphp
                        <span class="badge bg-{{ $badge }}">{{ ucfirst($p->status) }}</span>
                    </td>
                    <td>
                        <form action="{{ route('admin.peminjaman.status', $p->id) }}" method="POST" class="d-flex gap-1">
                            @csrf
                            <select name="status" class="form-select form-select-sm" style="width:130px">
                                <option value="menunggu"     {{ $p->status=='menunggu'    ?'selected':'' }}>Menunggu</option>
                                <option value="disetujui"    {{ $p->status=='disetujui'   ?'selected':'' }}>Disetujui</option>
                                <option value="ditolak"      {{ $p->status=='ditolak'     ?'selected':'' }}>Ditolak</option>
                                <option value="dikembalikan" {{ $p->status=='dikembalikan'?'selected':'' }}>Dikembalikan</option>
                            </select>
                            <button class="btn btn-sm btn-primary">Update</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center text-muted py-3">Belum ada peminjaman.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
</body>
</html>