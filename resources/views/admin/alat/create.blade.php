<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Alat</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light p-5">
<div class="container" style="max-width:500px">
    <h2 class="fw-bold mb-4">➕ Tambah Alat Baru</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach
        </div>
    @endif

    <div class="card shadow-sm p-4">
        <form action="{{ route('admin.alat.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Alat</label>
                <input type="text" name="nama_alat" class="form-control"
                       value="{{ old('nama_alat') }}" placeholder="Contoh: Obeng Philips" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Kategori</label>
                <select name="kategori" class="form-select" required>
                    <option value="">-- Pilih Kategori --</option>
                    <option value="Elektronik" {{ old('kategori')=='Elektronik'?'selected':'' }}>Elektronik</option>
                    <option value="Mekanik"    {{ old('kategori')=='Mekanik'   ?'selected':'' }}>Mekanik</option>
                    <option value="Perkakas"   {{ old('kategori')=='Perkakas'  ?'selected':'' }}>Perkakas</option>
                </select>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">💾 Simpan</button>
                <a href="{{ route('admin.alat.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>