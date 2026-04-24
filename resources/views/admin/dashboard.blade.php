<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin — SiPinjamAlat</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #f1f5f9; min-height: 100vh; display: flex; }

        /* SIDEBAR */
        .sidebar { width: 260px; background: linear-gradient(180deg, #0f172a 0%, #1e3a5f 100%); min-height: 100vh; padding: 0; display: flex; flex-direction: column; position: fixed; top: 0; left: 0; z-index: 100; }
        .sidebar-brand { padding: 24px 20px; border-bottom: 1px solid rgba(255,255,255,0.08); display: flex; align-items: center; gap: 12px; }
        .sidebar-brand .icon { width: 40px; height: 40px; background: linear-gradient(135deg, #1a56db, #06b6d4); border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 18px; }
        .sidebar-brand .name { color: #fff; font-weight: 800; font-size: 16px; }
        .sidebar-brand .role { color: rgba(255,255,255,0.4); font-size: 11px; }
        .sidebar-nav { padding: 16px 12px; flex: 1; }
        .nav-label { color: rgba(255,255,255,0.3); font-size: 10px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; padding: 8px 8px 4px; margin-top: 8px; }
        .nav-item { display: flex; align-items: center; gap: 10px; padding: 10px 12px; border-radius: 10px; color: rgba(255,255,255,0.6); font-size: 13.5px; font-weight: 500; text-decoration: none; transition: all 0.2s; margin-bottom: 2px; cursor: pointer; }
        .nav-item:hover { background: rgba(255,255,255,0.08); color: #fff; }
        .nav-item.active { background: linear-gradient(135deg, #1a56db, #1e429f); color: #fff; box-shadow: 0 4px 12px rgba(26,86,219,0.4); }
        .nav-item i { width: 18px; text-align: center; font-size: 14px; }
        .sidebar-footer { padding: 16px 12px; border-top: 1px solid rgba(255,255,255,0.08); }

        /* MAIN */
        .main { margin-left: 260px; flex: 1; display: flex; flex-direction: column; min-height: 100vh; }
        .topbar { background: #fff; padding: 16px 28px; display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid #e2e8f0; position: sticky; top: 0; z-index: 50; }
        .topbar-title { font-size: 18px; font-weight: 700; color: #0f172a; }
        .topbar-right { display: flex; align-items: center; gap: 12px; }
        .avatar { width: 36px; height: 36px; background: linear-gradient(135deg, #1a56db, #06b6d4); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 700; font-size: 14px; }
        .admin-name { font-size: 13px; font-weight: 600; color: #334155; }

        .content { padding: 28px; flex: 1; }

        /* STATS */
        .stats-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 28px; }
        .stat-card { background: #fff; border-radius: 16px; padding: 24px; display: flex; align-items: center; gap: 16px; box-shadow: 0 1px 3px rgba(0,0,0,0.07); border: 1px solid #f1f5f9; }
        .stat-icon { width: 52px; height: 52px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 22px; flex-shrink: 0; }
        .stat-icon.blue { background: rgba(26,86,219,0.1); color: #1a56db; }
        .stat-icon.cyan { background: rgba(6,182,212,0.1); color: #06b6d4; }
        .stat-icon.green { background: rgba(16,185,129,0.1); color: #10b981; }
        .stat-value { font-size: 28px; font-weight: 800; color: #0f172a; line-height: 1; }
        .stat-label { font-size: 13px; color: #64748b; margin-top: 4px; }

        /* SECTION */
        .section-card { background: #fff; border-radius: 16px; padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.07); border: 1px solid #f1f5f9; margin-bottom: 24px; }
        .section-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px; }
        .section-title { font-size: 15px; font-weight: 700; color: #0f172a; display: flex; align-items: center; gap: 8px; }
        .section-title i { color: #1a56db; }

        /* FORM TAMBAH */
        .add-form { display: flex; gap: 12px; flex-wrap: wrap; }
        .add-form input { flex: 1; min-width: 160px; padding: 10px 14px; border: 1.5px solid #e2e8f0; border-radius: 10px; font-family: inherit; font-size: 14px; color: #0f172a; outline: none; transition: border-color 0.2s; }
        .add-form input:focus { border-color: #1a56db; box-shadow: 0 0 0 3px rgba(26,86,219,0.1); }
        .btn { padding: 10px 18px; border: none; border-radius: 10px; font-family: inherit; font-size: 13.5px; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 6px; transition: all 0.2s; }
        .btn-primary { background: linear-gradient(135deg, #1a56db, #1e429f); color: #fff; box-shadow: 0 4px 12px rgba(26,86,219,0.3); }
        .btn-primary:hover { transform: translateY(-1px); box-shadow: 0 6px 16px rgba(26,86,219,0.4); }
        .btn-sm { padding: 6px 12px; font-size: 12px; border-radius: 8px; }
        .btn-warning { background: rgba(245,158,11,0.1); color: #d97706; border: 1px solid rgba(245,158,11,0.2); }
        .btn-warning:hover { background: rgba(245,158,11,0.2); }
        .btn-danger { background: rgba(239,68,68,0.1); color: #dc2626; border: 1px solid rgba(239,68,68,0.2); }
        .btn-danger:hover { background: rgba(239,68,68,0.2); }
        .btn-success { background: rgba(16,185,129,0.1); color: #059669; border: 1px solid rgba(16,185,129,0.2); }
        .btn-success:hover { background: rgba(16,185,129,0.2); }

        /* TABLE */
        table { width: 100%; border-collapse: collapse; }
        thead tr { background: #f8fafc; }
        th { padding: 11px 14px; text-align: left; font-size: 12px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 1px solid #e2e8f0; }
        td { padding: 13px 14px; font-size: 13.5px; color: #334155; border-bottom: 1px solid #f1f5f9; vertical-align: middle; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: #f8fafc; }
        .badge { display: inline-flex; align-items: center; padding: 3px 10px; border-radius: 20px; font-size: 11.5px; font-weight: 600; }
        .badge-green { background: rgba(16,185,129,0.1); color: #059669; }
        .badge-red { background: rgba(239,68,68,0.1); color: #dc2626; }
        .badge-blue { background: rgba(26,86,219,0.1); color: #1a56db; }

        /* EDIT INLINE */
        .edit-row td { background: #eff6ff; }
        .edit-input { padding: 6px 10px; border: 1.5px solid #1a56db; border-radius: 8px; font-family: inherit; font-size: 13px; width: 100%; outline: none; }
        .actions { display: flex; gap: 6px; }

        /* LOGOUT */
        .btn-logout { width: 100%; padding: 10px; background: rgba(239,68,68,0.1); color: #dc2626; border: 1px solid rgba(239,68,68,0.2); border-radius: 10px; font-family: inherit; font-size: 13px; font-weight: 600; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; transition: all 0.2s; }
        .btn-logout:hover { background: rgba(239,68,68,0.2); }

        .empty-state { text-align: center; padding: 40px; color: #94a3b8; }
        .empty-state i { font-size: 40px; margin-bottom: 12px; display: block; }
    </style>
</head>
<body>

{{-- SIDEBAR --}}
<aside class="sidebar">
    <div class="sidebar-brand">
        <div class="icon">🔧</div>
        <div>
            <div class="name">SiPinjamAlat</div>
            <div class="role">Admin Panel</div>
        </div>
    </div>
    <nav class="sidebar-nav">
        <div class="nav-label">Menu</div>
        <a class="nav-item active" href="{{ route('admin.dashboard') }}">
            <i class="fa-solid fa-gauge"></i> Dashboard
        </a>
        <a class="nav-item" href="{{ route('peminjaman.index') }}">
            <i class="fa-solid fa-handshake"></i> Peminjaman
        </a>
        <a class="nav-item" href="{{ route('laporan.index') }}">
            <i class="fa-solid fa-file-lines"></i> Laporan
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
        <div class="topbar-title">Dashboard Admin</div>
        <div class="topbar-right">
            <div class="avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
            <div class="admin-name">{{ Auth::user()->name }}</div>
        </div>
    </div>

    <div class="content">

        {{-- STATS --}}
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon blue"><i class="fa-solid fa-toolbox"></i></div>
                <div>
                    <div class="stat-value">{{ $alats->count() }}</div>
                    <div class="stat-label">Total Alat</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon cyan"><i class="fa-solid fa-handshake"></i></div>
                <div>
                    <div class="stat-value">{{ $peminjaman->count() }}</div>
                    <div class="stat-label">Total Peminjaman</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon green"><i class="fa-solid fa-users"></i></div>
                <div>
                    <div class="stat-value">{{ $anggota->count() }}</div>
                    <div class="stat-label">Total Anggota</div>
                </div>
            </div>
        </div>

        {{-- KELOLA ALAT --}}
        <div class="section-card">
            <div class="section-header">
                <div class="section-title"><i class="fa-solid fa-toolbox"></i> Kelola Alat</div>
            </div>

            {{-- Form Tambah --}}
           <form action="{{ route('alat.store') }}" method="POST" class="add-form" style="margin-bottom:20px;">
    @csrf
    <input type="text" name="nama_alat" placeholder="Nama Alat" required>
    <input type="text" name="kategori" placeholder="Kategori (cth: Elektronik)" required>
    <input type="number" name="stok" placeholder="Stok" min="0" required style="max-width:120px;">
    <button type="submit" class="btn btn-primary">
        <i class="fa-solid fa-plus"></i> Tambah Alat
    </button>
</form>

            {{-- Tabel Alat --}}
            @if($alats->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Alat</th>
                        <th>Stok</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($alats as $i => $alat)
                    <tr id="row-{{ $alat->id }}">
                        <td>{{ $i + 1 }}</td>
                        <td><strong>{{ $alat->nama_alat }}</strong></td>
                        <td>{{ $alat->stok }}</td>
                        <td>
                            @if($alat->stok > 0)
                                <span class="badge badge-green">Tersedia</span>
                            @else
                                <span class="badge badge-red">Habis</span>
                            @endif
                        </td>
                        <td>
                            <div class="actions">
                                <a href="{{ route('alat.edit', $alat->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fa-solid fa-pen"></i> Edit
                                </a>
                                <form action="{{ route('alat.destroy', $alat->id) }}" method="POST"
                                      onsubmit="return confirm('Hapus alat ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fa-solid fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="empty-state">
                <i class="fa-solid fa-box-open"></i>
                Belum ada alat. Tambahkan alat di atas!
            </div>
            @endif
        </div>

        {{-- PEMINJAMAN TERBARU --}}
        <div class="section-card">
            <div class="section-header">
                <div class="section-title"><i class="fa-solid fa-handshake"></i> Peminjaman Terbaru</div>
                <a href="{{ route('peminjaman.index') }}" class="btn btn-sm btn-primary">Lihat Semua</a>
            </div>
            @if($peminjaman->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Peminjam</th>
                        <th>Alat</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($peminjaman->take(5) as $i => $p)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $p->user->name ?? '-' }}</td>
                        <td>{{ $p->alat->nama_alat ?? '-' }}</td>
                        <td>
                            @if($p->status === 'dipinjam')
                                <span class="badge badge-blue">Dipinjam</span>
                            @elseif($p->status === 'dikembalikan')
                                <span class="badge badge-green">Dikembalikan</span>
                            @else
                                <span class="badge">{{ $p->status }}</span>
                            @endif
                        </td>
                        <td>
                            @if($p->status === 'dipinjam')
                            <form action="{{ route('peminjaman.kembali', $p->id) }}" method="POST">
                                @csrf @method('PATCH')
                                <button type="submit" class="btn btn-sm btn-success">
                                    <i class="fa-solid fa-rotate-left"></i> Kembalikan
                                </button>
                            </form>
                            @else
                                <span style="color:#94a3b8; font-size:12px;">Selesai</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="empty-state">
                <i class="fa-solid fa-handshake-slash"></i>
                Belum ada data peminjaman.
            </div>
            @endif
        </div>

    </div>
</div>

</body>
</html>