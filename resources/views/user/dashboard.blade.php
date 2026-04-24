<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard — SiPinjamAlat</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --blue: #1a56db; --blue2: #1e429f; --cyan: #06b6d4;
            --green: #10b981; --red: #ef4444;
            --navy: #0f172a; --navy2: #1e293b;
            --text: #f1f5f9; --muted: #94a3b8;
        }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #0a0f1e; color: var(--text); min-height: 100vh; }

        /* TOP NAV */
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
        .btn-logout { padding: 8px 16px; border-radius: 8px; background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.2); color: #fca5a5; font-family: inherit; font-size: 12.5px; font-weight: 600; cursor: pointer; transition: 0.2s; display: flex; align-items: center; gap: 6px; text-decoration: none; }
        .btn-logout:hover { background: rgba(239,68,68,0.2); }

        /* HERO */
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
        .hero-content { position: relative; z-index: 1; }
        .hero-tag { display: inline-flex; align-items: center; gap: 6px; background: rgba(6,182,212,0.12); border: 1px solid rgba(6,182,212,0.25); border-radius: 20px; padding: 5px 14px; font-size: 12px; color: var(--cyan); font-weight: 600; margin-bottom: 14px; }
        .hero-title { font-size: 28px; font-weight: 800; color: #fff; letter-spacing: -0.5px; }
        .hero-sub { font-size: 14px; color: var(--muted); margin-top: 6px; }

        /* CONTENT */
        .content { padding: 32px 40px; }

        /* STATS */
        .stats-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin-bottom: 32px; }
        .stat-card { background: var(--navy2); border: 1px solid rgba(255,255,255,0.06); border-radius: 16px; padding: 22px; display: flex; align-items: center; gap: 14px; }
        .stat-icon { width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 20px; flex-shrink: 0; }
        .stat-icon.blue   { background: rgba(26,86,219,0.2); color: #60a5fa; }
        .stat-icon.green  { background: rgba(16,185,129,0.2); color: #34d399; }
        .stat-icon.amber  { background: rgba(245,158,11,0.2); color: #fbbf24; }
        .stat-value { font-size: 26px; font-weight: 800; color: #fff; line-height: 1; }
        .stat-label { font-size: 12px; color: var(--muted); margin-top: 4px; }

        /* QUICK LINKS */
        .quick-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 16px; margin-bottom: 32px; }
        .quick-card { background: var(--navy2); border: 1px solid rgba(255,255,255,0.06); border-radius: 16px; padding: 24px; text-decoration: none; display: flex; align-items: center; gap: 16px; transition: all 0.2s; }
        .quick-card:hover { border-color: rgba(26,86,219,0.4); background: rgba(26,86,219,0.08); transform: translateY(-2px); }
        .quick-icon { width: 52px; height: 52px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 22px; flex-shrink: 0; }
        .quick-icon.blue { background: rgba(26,86,219,0.2); color: #60a5fa; }
        .quick-icon.amber { background: rgba(245,158,11,0.2); color: #fbbf24; }
        .quick-title { font-size: 15px; font-weight: 700; color: #fff; }
        .quick-sub { font-size: 12px; color: var(--muted); margin-top: 3px; }
        .quick-arrow { margin-left: auto; color: var(--muted); font-size: 14px; }

        /* RECENT */
        .section-card { background: var(--navy2); border: 1px solid rgba(255,255,255,0.06); border-radius: 16px; overflow: hidden; }
        .section-head { padding: 18px 24px; border-bottom: 1px solid rgba(255,255,255,0.06); display: flex; align-items: center; justify-content: space-between; }
        .section-title { font-size: 14px; font-weight: 700; color: #fff; display: flex; align-items: center; gap: 8px; }
        .section-title i { color: #60a5fa; }
        .see-all { font-size: 12.5px; color: #60a5fa; text-decoration: none; font-weight: 600; }
        .see-all:hover { text-decoration: underline; }

        table { width: 100%; border-collapse: collapse; }
        thead tr { background: rgba(255,255,255,0.03); }
        th { padding: 11px 18px; font-size: 11px; font-weight: 700; color: var(--muted); letter-spacing: 0.8px; text-transform: uppercase; }
        td { padding: 14px 18px; font-size: 13.5px; border-top: 1px solid rgba(255,255,255,0.03); vertical-align: middle; }

        .badge { display: inline-flex; align-items: center; padding: 4px 11px; border-radius: 20px; font-size: 11.5px; font-weight: 700; }
        .badge-blue  { background: rgba(26,86,219,0.15);  color: #60a5fa; }
        .badge-green { background: rgba(16,185,129,0.15); color: #34d399; }
        .badge-red   { background: rgba(239,68,68,0.15);  color: #f87171; }
        .badge-amber { background: rgba(245,158,11,0.15); color: #fbbf24; }
        .badge-gray  { background: rgba(100,116,139,0.15); color: #94a3b8; }

        .empty-state { text-align: center; padding: 48px; color: var(--muted); }
        .empty-state i { font-size: 40px; display: block; margin-bottom: 12px; opacity: 0.4; }
    </style>
</head>
<body>

{{-- TOP NAV --}}
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
                <div class="user-pill-role">Anggota</div>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-logout">
                <i class="fa-solid fa-right-from-bracket"></i> Logout
            </button>
        </form>
    </div>
</nav>

{{-- HERO --}}
<div class="hero">
    <div class="hero-content">
        <div class="hero-tag"><i class="fa-solid fa-hand-wave"></i> Selamat Datang</div>
        <div class="hero-title">Halo, {{ auth()->user()->name }}! 👋</div>
        <div class="hero-sub">Selamat datang di SiPinjamAlat. Apa yang ingin kamu pinjam hari ini?</div>
    </div>
</div>

{{-- CONTENT --}}
<div class="content">

    {{-- STATS --}}
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon blue"><i class="fa-solid fa-handshake"></i></div>
            <div>
                <div class="stat-value">{{ $totalPinjam }}</div>
                <div class="stat-label">Total Peminjaman</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon amber"><i class="fa-solid fa-clock"></i></div>
            <div>
                <div class="stat-value">{{ $sedangDipinjam }}</div>
                <div class="stat-label">Sedang Dipinjam</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon green"><i class="fa-solid fa-circle-check"></i></div>
            <div>
                <div class="stat-value">{{ $sudahKembali }}</div>
                <div class="stat-label">Sudah Dikembalikan</div>
            </div>
        </div>
    </div>

    {{-- QUICK LINKS --}}
    <div class="quick-grid">
        <a href="{{ route('koleksi.index') }}" class="quick-card">
            <div class="quick-icon blue"><i class="fa-solid fa-magnifying-glass"></i></div>
            <div>
                <div class="quick-title">Cari & Pinjam Alat</div>
                <div class="quick-sub">Lihat semua alat yang tersedia</div>
            </div>
            <i class="fa-solid fa-chevron-right quick-arrow"></i>
        </a>
        <a href="{{ route('riwayat.index') }}" class="quick-card">
            <div class="quick-icon amber"><i class="fa-solid fa-clock-rotate-left"></i></div>
            <div>
                <div class="quick-title">Riwayat Pinjam</div>
                <div class="quick-sub">Pantau status peminjaman kamu</div>
            </div>
            <i class="fa-solid fa-chevron-right quick-arrow"></i>
        </a>
    </div>

    {{-- PEMINJAMAN TERBARU --}}
    <div class="section-card">
        <div class="section-head">
            <div class="section-title">
                <i class="fa-solid fa-clock-rotate-left"></i> Peminjaman Terbaru
            </div>
            <a href="{{ route('riwayat.index') }}" class="see-all">Lihat Semua →</a>
        </div>
        @if($riwayatTerbaru->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>Nama Alat</th>
                    <th>Tgl Pinjam</th>
                    <th>Rencana Kembali</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($riwayatTerbaru as $p)
                <tr>
                    <td style="font-weight:600; color:#fff;">{{ $p->alat->nama_alat ?? '-' }}</td>
                    <td style="color:var(--muted); font-size:13px;">
                        {{ $p->tanggal_pinjam ? \Carbon\Carbon::parse($p->tanggal_pinjam)->format('d M Y') : $p->created_at->format('d M Y') }}
                    </td>
                    <td style="color:var(--muted); font-size:13px;">
                        {{ $p->tanggal_kembali ? \Carbon\Carbon::parse($p->tanggal_kembali)->format('d M Y') : '-' }}
                    </td>
                    <td>
                        @if($p->status === 'dipinjam')
                            <span class="badge badge-blue">Dipinjam</span>
                        @elseif($p->status === 'dikembalikan')
                            <span class="badge badge-green">Dikembalikan</span>
                        @elseif($p->status === 'terlambat')
                            <span class="badge badge-red">Terlambat</span>
                        @elseif($p->status === 'menunggu')
                            <span class="badge badge-amber">Menunggu</span>
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
            <i class="fa-solid fa-box-open"></i>
            Belum ada riwayat peminjaman.<br>
            <small>Mulai pinjam alat sekarang!</small>
        </div>
        @endif
    </div>

</div>
</body>
</html>