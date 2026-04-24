<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body  { font-family: Arial, sans-serif; font-size: 13px; }
        h2    { text-align: center; }
        p     { text-align: center; color: #555; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th,td { border: 1px solid #333; padding: 8px; }
        th    { background: #333; color: #fff; }
        tr:nth-child(even) { background: #f2f2f2; }
        .footer { text-align:center; margin-top:20px; font-size:11px; color:#888; }
    </style>
</head>
<body>
    <h2>Laporan Data Alat</h2>
    <p>Dicetak: {{ now()->format('d/m/Y H:i') }}</p>
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
    <div class="footer">Total: {{ $alats->count() }} alat</div>
</body>
</html>