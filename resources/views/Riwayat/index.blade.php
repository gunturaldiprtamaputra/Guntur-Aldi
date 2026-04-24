<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pinjam — SiPinjamAlat</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #f1f5f9; min-height: 100vh; display: flex; }

        /* SIDEBAR */
        .sidebar { width: 260px; background: linear-gradient(180deg, #0f172a 0%, #1e3a5f 100%); min-height: 100vh; display: flex; flex-direction: column; position: fixed; top: 0; left: 0; z-index: 100; }
        .sidebar-brand { padding: 24px 20px; border-bottom: 1px solid rgba(255,255,255,0.08); display: flex; align-items: center; gap: 12px; }
        .sidebar-brand .icon { width: 40px; height: 40px; background: linear-gradient(135deg, #1a56db, #06b6d4); border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 18px; }
        .sidebar-brand .name { color: #fff; font-weight: 800; font-size: 16px; }
        .sidebar-brand .role { color: rgba(255,255,255,0.4); font-size: 11px; }
        .sidebar-nav { padding: 16px 12px; flex: 1; }
        .nav-label { color: rgba(255,255,255,0.3); font-size: 10px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; padding: 8px 8px 4px; margin-top: 8px; }
        .nav-item { display: flex; align-items: center; gap: 10px; padding: 10px 12px; border-radius: 10px; color: rgba(255,255,255,0.6); font-size: 13.5px; font-weight: 500; text-decoration: none; transition: all 0.2s; margin-bottom: 2px; }
        .nav-item:hover { background: rgba(255,255,255,0.08); color: #fff; }
        .nav-item.active { background: linear-gradient(135deg, #1a56db, #1e429f); color: #fff; box-shadow: 0 4px 12px rgba(26,86,219,0.4); }
        .nav-item i { width: 18px; text-align: center; font-size: 14px; }
        .sidebar-footer { padding: 16px 12px; border-top: 1px solid rgba(255,255,255,0.08); }
        .btn-logout { width: 100%; padding: 10px; background: rgba(239,68,68,0.1); color: #dc2626; border: 1px solid rgba(239,68,68,0.2); border-radius: 10px; font-family: inherit; font-size: 13px; font-weight: 600; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; transition: all 0.2s; }
        .btn-logout:hover { background: rgba(239,68,68,0.2); }

        /* MAIN */
        .main { margin-left: 260px; flex: 1; display: flex; flex-direction: column; }
        .topbar { background: #fff; padding: 16px 28px; display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid #e2e8f0; position: sticky; top: 0; z-index: 50; }
        .topbar-title { font-size: 18px; font-weight: 700; color: #0f172a; }
        .topbar-right { display: flex; align-items: center; gap: 12px; }
        .avatar { width: 36px; height: 36px; background: linear-gradient(135deg, #1a56db, #06b6d4); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 700; font-size: 14px; }
        .admin-name { font-size: 13px; font-weight: 600; color: #334155; }

        .content { padding: 28px; flex: 1; }

        /* ALERT */
        .alert { padding: 14px 18px; border-radius: 12px; margin-bottom: 20px; font-size: 13.5px; font-weight: 500; display: flex; align-items: center; gap: 10px; }
        .alert-success { background: rgba(16,185,129,0.1); color: #059669; border: 1px solid rgba(16,185,129,0.2); }

        /* SECTION */
        .section-card { background: #fff; border-radius: 16px; padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.07); border: 1px solid #f1f5f9; }
        .section-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px; }
        .section-title { font-size: 15px; font-weight: 700; color: #0f172a; display: flex; align-items: center; gap: 8px; }
        .section-title i { color: #1a56db; }

        /* BTN */
        .btn { padding: 9px 16px; border: none; border-radius: 10px; font-family: inherit; font-size: 13px; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 6px; transition: all 0.2s; text-decoration: none; }
        .btn-primary { background: linear-gradient(135deg, #1a56db, #1e429f); color: #fff; box-shadow: 0 4px 12px rgba(26,86,219,0.3); }
        .btn-primary:hover { transform: translateY(-1px); }

        /* TABLE */
        table { width: 100%; border-collapse: collapse; }
        thead tr { background: #f8fafc; }
        th { padding: 11px 14px; text-align: left; font-size: 12px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 1px solid #e2e8f0; }
        td { padding: 14px; font-size: 13.5px; color: #334155; border-bottom: 1px solid #f1f5f9; vertical-align: middle; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: #f8fafc; }

        .badge { display: inline-flex; align-items: center; padding: 4px 12px; border-radius: 20px; font-size: 11.5px; font-weight: 600; }
        .badge-blue   { background: rgba(26,86,219,0.1);  color: #1a56db; }
        .badge-green  { background: rgba(16,185,129,0.1); color: #059669; }
        .badge-red    { background: rgba(239,68,68,0.1);  color: #dc2626; }
        .badge-gray   { background: #f1f5f9; color: #64748b; }

        .empty-state { text-align: center; padding: 60px; color: #94a3b8; }
        .empty-state i { font-size: 48px; margin-bottom: 14px; display: block; }
        .empty-state a { margin-top: 16px; display: inline-flex; }
    </style>
</head>
<body>

{{-- SIDEBAR --}}
<aside class="sidebar">
    <div class="sidebar-brand">
        <div class="icon">🔧</div>
        <div>
            <div class="name">SiPinjamAlat</div>
            <div class="role">Panel Anggota</div>
        </div>
    </div>
    <nav class="sidebar-nav">
        <div class="nav-label">Menu</div>
        <a class="nav-item" href="{{ route('koleksi.index') }}">
            <i class="fa-solid fa-magnifying-glass"></i> Cari Alat
        </a>
        <a class="nav-item active" href="{{ route('riwayat.index') }}">
            <i class="fa-solid fa-clock-rotate-left"></i> Riwayat Pinjam
        </a>
        <div class="nav-label">Akun</div>
        <a class="nav-item" href="{{ route('profile.edit') }}">
            <i class="fa-solid fa-user"></i> Profil Saya
        </a>
    </nav>
    <div class="sidebar-footer">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-logout">
                <i class="fa-solid fa-right-from-bracket"></i> Logout
            </button>
        </form>
    </div>
</aside>

{{-- MAIN --}}
<div class="main">
    <div class="topbar">
        <div class="topbar-title">Riwayat Pinjam Saya</div>
        <div class="topbar-right">
            <div class="avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
            <div class="admin-name">{{ Auth::user()->name }}</div>
        </div>
    </div>

    <div class="content">

        @if(session('success'))
        <div class="alert alert-success">
            <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
        </div>
        @endif

        <div class="section-card">
            <div class="section-header">
                <div class="section-title">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                    Riwayat Peminjaman
                </div>
                <a href="{{ route('koleksi.index') }}" class="btn btn-primary">
                    <i class="fa-solid fa-plus"></i> Pinjam Alat Baru
                </a>
            </div>

            @if($riwayat->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Alat</th>
                        <th>Tgl Pinjam</th>
                        <th>Rencana Kembali</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($riwayat as $i => $p)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td><strong>{{ $p->alat->nama_alat ?? '-' }}</strong></td>
                        <td>{{ $p->tanggal_pinjam ? \Carbon\Carbon::parse($p->tanggal_pinjam)->format('d M Y') : ($p->created_at->format('d M Y')) }}</td>
                        <td>
                            @if($p->tanggal_kembali)
                                {{ \Carbon\Carbon::parse($p->tanggal_kembali)->format('d M Y') }}
                                @if($p->status === 'dipinjam' && \Carbon\Carbon::parse($p->tanggal_kembali)->isPast())
                                    <br><small style="color:#dc2626; font-size:11px;">⚠ Terlambat!</small>
                                @endif
                            @else
                                <span style="color:#94a3b8;">—</span>
                            @endif
                        </td>
                        <td>
                            @if($p->status === 'dipinjam')
                                <span class="badge badge-blue">Dipinjam</span>
                            @elseif($p->status === 'dikembalikan')
                                <span class="badge badge-green">Dikembalikan</span>
                            @elseif($p->status === 'terlambat')
                                <span class="badge badge-red">Terlambat</span>
                            @else
                                <span class="badge badge-gray">{{ ucfirst($p->status) }}</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="empty-state">
                <i class="fa-solid fa-clock-rotate-left"></i>
                <strong>Belum ada riwayat peminjaman</strong><br>
                <small>Anda belum pernah meminjam alat</small><br>
                <a href="{{ route('koleksi.index') }}" class="btn btn-primary">
                    <i class="fa-solid fa-magnifying-glass"></i> Cari & Pinjam Alat
                </a>
            </div>
            @endif
        </div>

    </div>
</div>

</body>
</html>