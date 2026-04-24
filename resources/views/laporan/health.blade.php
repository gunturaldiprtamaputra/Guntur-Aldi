<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Health Check</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light p-4">
<div class="container" style="max-width:600px">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">🩺 Kesehatan Web</h2>
        <a href="{{ route('laporan.index') }}" class="btn btn-outline-secondary">← Kembali</a>
    </div>

    <div class="alert {{ $status === 'Sehat' ? 'alert-success' : 'alert-danger' }} fw-bold fs-5">
        Status: {{ $status }}
    </div>

    @foreach($checks as $nama => $result)
    <div class="card mb-2 shadow-sm">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div>
                <strong>{{ ucfirst($nama) }}</strong>
                <div class="text-muted small">{{ $result['pesan'] }}</div>
            </div>
            <span class="badge {{ $result['status']==='OK' ? 'bg-success' : 'bg-danger' }} fs-6">
                {{ $result['status'] }}
            </span>
        </div>
    </div>
    @endforeach

    <div class="text-muted small mt-3">Dicek: {{ now()->format('d/m/Y H:i:s') }}</div>
</div>
</body>
</html>