<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peminjaman Alat — User</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --blue: #1a56db; --blue2: #1e429f; --cyan: #06b6d4;
            --green: #10b981; --amber: #f59e0b; --red: #ef4444;
            --navy: #0f172a; --navy2: #1e293b; --navy3: #334155;
            --text: #f1f5f9; --muted: #94a3b8;
        }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #0a0f1e; color: var(--text); min-height: 100vh; }

        /* Top nav */
        .topnav {
            background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 100%);
            border-bottom: 1px solid rgba(255,255,255,0.07);
            padding: 0 32px; height: 64px;
            display: flex; align-items: center; justify-content: space-between;
            position: sticky; top: 0; z-index: 100;
        }
        .nav-brand { display: flex; align-items: center; gap: 10px; }
        .nav-logo { width: 36px; height: 36px; background: linear-gradient(135deg, var(--blue), var(--cyan)); border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 17px; }
        .nav-title { font-size: 16px; font-weight: 800; color: #fff; }
        .nav-right { display: flex; align-items: center; gap: 16px; }
        .user-pill { display: flex; align-items: center; gap: 10px; padding: 6px 14px; background: rgba(255,255,255,0.06); border-radius: 20px; }
        .user-pill-avatar { width: 28px; height: 28px; border-radius: 8px; background: linear-gradient(135deg, var(--blue), var(--cyan)); display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 700; color: #fff; }
        .user-pill-name { font-size: 13px; font-weight: 600; color: #fff; }
        .user-pill-role { font-size: 10.5px; color: var(--cyan); font-weight: 600; }
        .btn-logout { padding: 8px 16px; border-radius: 8px; background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.2); color: #fca5a5; font-family: inherit; font-size: 12.5px; font-weight: 600; cursor: pointer; transition: 0.2s; display: flex; align-items: center; gap: 6px; }
        .btn-logout:hover { background: rgba(239,68,68,0.2); }

        /* Hero */
        .hero {
            padding: 44px 40px 36px;
            background: linear-gradient(135deg, #0f172a 0%, #1a2d4f 50%, #0c3a5a 100%);
            position: relative; overflow: hidden;
        }
        .hero::before {
            content: '';
            position: absolute; inset: 0;
            background: radial-gradient(ellipse 60% 80% at 80% 50%, rgba(6,182,212,0.12) 0%, transparent 70%);
        }
        .hero-content { position: relative; z-index: 1; max-width: 700px; }
        .hero-tag { display: inline-flex; align-items: center; gap: 6px; background: rgba(6,182,212,0.12); border: 1px solid rgba(6,182,212,0.25); border-radius: 20px; padding: 5px 14px; font-size: 12px; color: var(--cyan); font-weight: 600; margin-bottom: 14px; }
        .hero-title { font-size: 28px; font-weight: 800; color: #fff; letter-spacing: -0.5px; }
        .hero-sub { font-size: 14px; color: var(--muted); margin-top: 6px; }

        /* Content */
        .content { padding: 32px 40px; max-width: 1000px; }

        /* Form card */
        .form-card {
            background: var(--navy2); border: 1px solid rgba(255,255,255,0.06);
            border-radius: 20px; overflow: hidden; margin-bottom: 32px;
        }
        .form-card-header {
            background: linear-gradient(135deg, rgba(26,86,219,0.15), rgba(6,182,212,0.08));
            border-bottom: 1px solid rgba(255,255,255,0.06);
            padding: 20px 28px; display: flex; align-items: center; gap: 12px;
        }
        .form-card-icon { width: 40px; height: 40px; border-radius: 10px; background: rgba(26,86,219,0.2); display: flex; align-items: center; justify-content: center; font-size: 18px; }
        .form-card-title { font-size: 15px; font-weight: 700; color: #fff; }
        .form-card-body { padding: 28px; }

        .form-row { display: grid; grid-template-columns: 2fr 1.5fr 1.5fr auto; gap: 14px; align-items: end; }
        .form-group { display: flex; flex-direction: column; gap: 8px; }
        .form-label { font-size: 12.5px; font-weight: 600; color: rgba(255,255,255,0.6); letter-spacing: 0.3px; }
        .input-wrap { position: relative; }
        .input-icon { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: rgba(255,255,255,0.3); font-size: 14px; pointer-events: none; }
        .form-control { width: 100%; padding: 11px 12px 11px 38px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.10); border-radius: 10px; color: #fff; font-family: inherit; font-size: 13.5px; outline: none; transition: 0.2s; }
        .form-control::placeholder { color: rgba(255,255,255,0.2); }
        .form-control:focus { border-color: rgba(26,86,219,0.5); background: rgba(26,86,219,0.08); }
        select.form-control { appearance: none; cursor: pointer; }

        .btn-ajukan { padding: 11px 24px; border-radius: 10px; background: linear-gradient(135deg, var(--blue), var(--blue2)); border: none; color: #fff; font-family: inherit; font-size: 14px; font-weight: 700; cursor: pointer; transition: 0.2s; white-space: nowrap; display: flex; align-items: center; gap: 8px; box-shadow: 0 4px 14px rgba(26,86,219,0.4); }
        .btn-ajukan:hover { transform: translateY(-1px); box-shadow: 0 6px 18px rgba(26,86,219,0.5); }

        /* Alert */
        .alert { border-radius: 12px; padding: 14px 18px; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; font-size: 13.5px; }
        .alert-success { background: rgba(16,185,129,0.12); border: 1px solid rgba(16,185,129,0.25); color: #6ee7b7; }
        .alert-danger  { background: rgba(239,68,68,0.12);  border: 1px solid rgba(239,68,68,0.25);  color: #fca5a5; }
        .alert-dismiss { margin-left: auto; background: none; border: none; color: inherit; cursor: pointer; font-size: 16px; opacity: 0.6; }
        .alert-dismiss:hover { opacity: 1; }

        /* History table */
        .table-card { background: var(--navy2); border: 1px solid rgba(255,255,255,0.06); border-radius: 20px; overflow: hidden; }
        .table-header { padding: 20px 28px; border-bottom: 1px solid rgba(255,255,255,0.06); display: flex; align-items: center; gap: 12px; }
        .table-header-icon { width: 36px; height: 36px; border-radius: 9px; background: rgba(245,158,11,0.15); display: flex; align-items: center; justify-content: center; font-size: 16px; }
        .table-title { font-size: 15px; font-weight: 700; color: #fff; }
        .table-count { margin-left: auto; background: rgba(255,255,255,0.06); border-radius: 6px; padding: 3px 10px; font-size: 12px; color: var(--muted); font-weight: 600; }
        .table-scroll { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; }
        thead tr { background: rgba(255,255,255,0.03); border-bottom: 1px solid rgba(255,255,255,0.05); }
        thead th { padding: 12px 18px; font-size: 11px; font-weight: 700; color: var(--muted); letter-spacing: 0.8px; text-transform: uppercase; white-space: nowrap; }
        tbody tr { border-bottom: 1px solid rgba(255,255,255,0.03); transition: 0.15s; }
        tbody tr:last-child { border-bottom: none; }
        tbody tr:hover { background: rgba(255,255,255,0.02); }
        td { padding: 14px 18px; font-size: 13.5px; vertical-align: middle; }

        /* Alat info in table */
        .alat-thumb { width: 44px; height: 44px; border-radius: 9px; object-fit: cover; border: 1px solid rgba(255,255,255,0.08); }
        .alat-thumb-ph { width: 44px; height: 44px; border-radius: 9px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.06); display: flex; align-items: center; justify-content: center; font-size: 18px; }
        .alat-row { display: flex; align-items: center; gap: 12px; }
        .alat-name-cell { font-weight: 600; color: #fff; font-size: 13.5px; }
        .alat-kat { font-size: 11.5px; color: var(--muted); margin-top: 2px; }

        .badge { display: inline-flex; align-items: center; gap: 5px; padding: 4px 11px; border-radius: 20px; font-size: 11.5px; font-weight: 700; }
        .badge-menunggu    { background: rgba(245,158,11,0.15); color: #fbbf24; }
        .badge-disetujui   { background: rgba(16,185,129,0.15); color: #34d399; }
        .badge-ditolak     { background: rgba(239,68,68,0.15);  color: #f87171; }
        .badge-dikembalikan{ background: rgba(6,182,212,0.15);  color: #22d3ee; }
        .badge-secondary   { background: rgba(100,116,139,0.15); color: #94a3b8; }

        .empty-cell { text-align: center; padding: 60px; color: var(--muted); }
        .empty-icon-big { font-size: 48px; display: block; margin-bottom: 12px; }
    </style>
</head>
<body>
    <!-- TOP NAV -->
    <nav class="topnav">
        <div class="nav-brand">
            <div class="nav-logo">🔧</div>
            <div class="nav-title">SiPinjamAlat</div>
        </div>
        <div class="nav-right">
            <div class="user-pill">
                <div class="user-pill-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                <div>
                    <div class="user-pill-name">{{ auth()->user()->name }}</div>
                    <div class="user-pill-role">User</div>
                </div>
            </div>
            <form method="POST" action="/logout">@csrf
                <button type="submit" class="btn-logout">
                    <i class="fa-solid fa-right-from-bracket"></i> Logout
                </button>
            </form>
        </div>
    </nav>

    <!-- HERO -->
    <div class="hero">
        <div class="hero-content">
            <div class="hero-tag"><i class="fa-solid fa-screwdriver-wrench"></i> Portal Peminjaman</div>
            <div class="hero-title">Peminjaman Alat</div>
            <div class="hero-sub">Ajukan peminjaman alat dan pantau status permintaan kamu di sini.</div>
        </div>
    </div>

    <!-- CONTENT -->
    <div class="content">
        @if(session('success'))
            <div class="alert alert-success">
                <i class="fa-solid fa-circle-check"></i>
                {{ session('success') }}
                <button class="alert-dismiss" onclick="this.parentElement.remove()">✕</button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">
                <i class="fa-solid fa-circle-exclamation"></i>
                {{ session('error') }}
                <button class="alert-dismiss" onclick="this.parentElement.remove()">✕</button>
            </div>
        @endif

        <!-- FORM AJUKAN -->
        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-icon">📋</div>
                <div>
                    <div class="form-card-title">Ajukan Peminjaman Alat</div>
                </div>
            </div>
            <div class="form-card-body">
                <form method="POST" action="{{ route('pinjam.store') }}">
                    @csrf
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Pilih Alat</label>
                            <div class="input-wrap">
                                <i class="fa-solid fa-screwdriver-wrench input-icon"></i>
                                <select name="alat_id" class="form-control" required>
                                    <option value="">-- Pilih Alat --</option>
                                    @foreach($alats as $a)
                                        @php $kondisi = strtolower($a->kondisi ?? 'baik'); @endphp
                                        @if($kondisi == 'baik')
                                        <option value="{{ $a->id }}">{{ $a->nama_alat }} ({{ $a->kategori }})</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Tanggal Pinjam</label>
                            <div class="input-wrap">
                                <i class="fa-solid fa-calendar-days input-icon"></i>
                                <input type="date" name="tanggal_pinjam" class="form-control"
                                       min="{{ date('Y-m-d') }}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Catatan (opsional)</label>
                            <div class="input-wrap">
                                <i class="fa-solid fa-pen input-icon"></i>
                                <input type="text" name="catatan" class="form-control" placeholder="Keperluan...">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">&nbsp;</label>
                            <button type="submit" class="btn-ajukan">
                                <i class="fa-solid fa-paper-plane"></i> Ajukan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- RIWAYAT -->
        <div class="table-card">
            <div class="table-header">
                <div class="table-header-icon">📜</div>
                <div class="table-title">Riwayat Peminjaman Saya</div>
                <div class="table-count">{{ $peminjamans->count() }} data</div>
            </div>
            <div class="table-scroll">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Foto</th>
                            <th>Nama Alat</th>
                            <th>Kategori</th>
                            <th>Kondisi</th>
                            <th>Tanggal Pinjam</th>
                            <th>Catatan</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($peminjamans as $i => $p)
                        <tr>
                            <td style="color:var(--muted);font-size:12px">{{ $i + 1 }}</td>
                            <td>
                                @if($p->alat->foto)
                                    <img src="{{ asset('storage/' . $p->alat->foto) }}" class="alat-thumb" alt="">
                                @else
                                    <div class="alat-thumb-ph">🔧</div>
                                @endif
                            </td>
                            <td>
                                <div class="alat-name-cell">{{ $p->alat->nama_alat }}</div>
                            </td>
                            <td><span class="badge badge-secondary">{{ $p->alat->kategori }}</span></td>
                            <td>
                                @php $k = strtolower($p->alat->kondisi ?? 'baik'); @endphp
                                <span style="font-size:13px">{{ $k=='baik' ? '✅ Baik' : '🔴 Rusak' }}</span>
                            </td>
                            <td style="color:var(--muted);font-size:13px">{{ $p->tanggal_pinjam }}</td>
                            <td style="color:var(--muted);font-size:13px">{{ $p->catatan ?? '-' }}</td>
                            <td>
                                @php
                                    $cls = match($p->status) {
                                        'menunggu'     => 'badge-menunggu',
                                        'disetujui'    => 'badge-disetujui',
                                        'ditolak'      => 'badge-ditolak',
                                        'dikembalikan' => 'badge-dikembalikan',
                                        default        => 'badge-secondary'
                                    };
                                    $icon = match($p->status) {
                                        'menunggu'     => '⏳',
                                        'disetujui'    => '✅',
                                        'ditolak'      => '❌',
                                        'dikembalikan' => '↩️',
                                        default        => '•'
                                    };
                                @endphp
                                <span class="badge {{ $cls }}">{{ $icon }} {{ ucfirst($p->status) }}</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="empty-cell">
                                <span class="empty-icon-big">📭</span>
                                Belum ada riwayat peminjaman.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>