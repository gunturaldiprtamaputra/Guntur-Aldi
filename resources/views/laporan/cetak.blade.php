<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Cetak Laporan</title>
    <style>
        body  { font-family: Arial; padding: 30px; }
        table { width: 100%; border-collapse: collapse; }
        th,td { border: 1px solid #000; padding: 7px; }
        th    { background: #000; color: #fff; }
        @media print { .no-print { display: none; } }
    </style>
</head>
<body>
    <h2>Laporan Data Alat</h2>
    <p>Tanggal cetak: {{ now()->format('d/m/Y H:i') }}</p>
    <button class="no-print" onclick="window.print()" style="margin-bottom:15px;padding:8px 20px">🖨 Print</button>
    <table>
        <thead>
            <tr><th>#</th><th>Nama Alat</th><th>Kategori</th><th>Tanggal Simpan</th></tr>
        </thead>
        <tbody>
            @foreach($alats as $i => $a)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $a->nama_alat }}</td>
                <td>{{ $a->kategori }}</td>
                <td>{{ $a->created_at->format('d/m/Y H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <p><strong>Total: {{ $alats->count() }} alat</strong></p>
</body>
</html>