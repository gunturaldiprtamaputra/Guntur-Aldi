<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Alat — Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root { --sidebar-w: 260px; --navy2: #1e293b; --navy3: #334155; --blue: #1a56db; --cyan: #06b6d4; --green: #10b981; --amber: #f59e0b; --red: #ef4444; --text: #f1f5f9; --muted: #94a3b8; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #0a0f1e; color: var(--text); min-height: 100vh; display: flex; }
        .sidebar { width: var(--sidebar-w); background: linear-gradient(180deg, #0f172a 0%, #0d1b35 100%); border-right: 1px solid rgba(255,255,255,0.06); display: flex; flex-direction: column; position: fixed; top: 0; left: 0; height: 100vh; z-index: 100; }
        .sidebar-brand { padding: 28px 24px 24px; border-bottom: 1px solid rgba(255,255,255,0.06); }
        .brand-row { display: flex; align-items: center; gap: 12px; }
        .brand-logo { width: 42px; height: 42px; background: linear-gradient(135deg, var(--blue), var(--cyan)); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 20px; flex-shrink: 0; }
        .brand-name { font-size: 17px; font-weight: 800; color: #fff; }
        .brand-role { font-size: 11px; color: var(--cyan); font-weight: 600; letter-spacing: 0.8px; text-transform: uppercase; margin-top: 2px; }
        .sidebar-nav { flex: 1; padding: 20px 12px; }
        .nav-section-label { font-size: 10px; font-weight: 700; letter-spacing: 1.2px; text-transform: uppercase; color: var(--navy3); padding: 0 12px; margin: 16px 0 8px; }
        .nav-item { display: flex; align-items: center; gap: 12px; padding: 11px 14px; border-radius: 10px; color: var(--muted); font-size: 14px; font-weight: 500; text-decoration: none; transition: all 0.2s; margin-bottom: 2px; }
        .nav-item i { width: 18px; text-align: center; font-size: 15px; }
        .nav-item:hover { background: rgba(255,255,255,0.06); color: #fff; }
        .nav-item.active { background: linear-gradient(135deg, rgba(26,86,219,0.3), rgba(6,182,212,0.15)); color: #fff; border: 1px solid rgba(26,86,219,0.3); }
        .nav-item.active i { color: var(--cyan); }
        .sidebar-footer { padding: 16px 12px; border-top: 1px solid rgba(255,255,255,0.06); }
        .user-card { display: flex; align-items: center; gap: 10px; padding: 10px 12px; border-radius: 10px; background: rgba(255,255,255,0.04); margin-bottom: 8px; }
        .user-avatar { width: 36px; height: 36px; border-radius: 10px; background: linear-gradient(135deg, var(--blue), var(--cyan)); display: flex; align-items: center; justify-content: center; font-size: 14px; font-weight: 700; color: #fff; flex-shrink: 0; }
        .user-name { font-size: 13px; font-weight: 600; color: #fff; }
        .user-email { font-size: 11px; color: var(--muted); }
        .btn-logout { width: 100%; padding: 10px; border-radius: 10px; background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.2); color: #fca5a5; font-family: inherit; font-size: 13px; font-weight: 600; cursor: pointer; transition: all 0.2s; display: flex; align-items: center; justify-content: center; gap: 8px; }
        .btn-logout:hover { background: rgba(239,68,68,0.2); }

        .main-content { margin-left: var(--sidebar-w); flex: 1; }
        .page-header { padding: 32px 40px 28px; background: linear-gradient(135deg, #0f172a 0%, #1e2d45 100%); border-bottom: 1px solid rgba(255,255,255,0.06); display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 16px; }
        .page-title { font-size: 24px; font-weight: 800; color: #fff; }
        .btn-add { padding: 11px 22px; border-radius: 10px; background: linear-gradient(135deg, var(--blue), #1e429f); border: none; color: #fff; font-family: inherit; font-size: 13.5px; font-weight: 700; cursor: pointer; text-decoration: none; display: flex; align-items: center; gap: 8px; box-shadow: 0 4px 14px rgba(26,86,219,0.4); transition: 0.2s; }
        .btn-add:hover { transform: translateY(-1px); }

        .content-body { padding: 32px 40px; }

        .alert-success { background: rgba(16,185,129,0.12); border: 1px solid rgba(16,185,129,0.3); border-radius: 12px; padding: 14px 18px; color: #6ee7b7; font-size: 13.5px; margin-bottom: 24px; display: flex; align-items: center; gap: 10px; }

        /* Filter card */
        .filter-card { background: var(--navy2); border: 1px solid rgba(255,255,255,0.06); border-radius: 16px; padding: 20px 24px; margin-bottom: 24px; }
        .filter-row { display: flex; gap: 12px; flex-wrap: wrap; align-items: center; }
        .filter-input-wrap { position: relative; flex: 1; min-width: 200px; }
        .filter-icon { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: rgba(255,255,255,0.3); font-size: 14px; }
        .filter-input { width: 100%; padding: 10px 12px 10px 36px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.10); border-radius: 10px; color: #fff; font-family: inherit; font-size: 13.5px; outline: none; transition: 0.2s; }
        .filter-input:focus { border-color: rgba(26,86,219,0.5); background: rgba(26,86,219,0.07); }
        .filter-input::placeholder { color: rgba(255,255,255,0.2); }
        select.filter-input { cursor: pointer; appearance: none; min-width: 160px; flex: 0; }
        .btn-filter { padding: 10px 20px; border-radius: 10px; background: rgba(255,255,255,0.07); border: 1px solid rgba(255,255,255,0.10); color: var(--muted); font-family: inherit; font-size: 13px; font-weight: 600; cursor: pointer; transition: 0.2s; }
        .btn-filter:hover { background: rgba(255,255,255,0.12); color: #fff; }
        .btn-reset { padding: 10px 16px; border-radius: 10px; background: rgba(239,68,68,0.10); border: 1px solid rgba(239,68,68,0.20); color: #fca5a5; font-family: inherit; font-size: 13px; font-weight: 600; cursor: pointer; text-decoration: none; transition: 0.2s; }
        .btn-reset:hover { background: rgba(239,68,68,0.18); }

        /* Table */
        .table-card { background: var(--navy2); border: 1px solid rgba(255,255,255,0.06); border-radius: 16px; overflow: hidden; }
        .table-scroll { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; }
        thead tr { background: rgba(255,255,255,0.04); border-bottom: 1px solid rgba(255,255,255,0.06); }
        thead th { padding: 14px 18px; font-size: 11.5px; font-weight: 700; color: var(--muted); letter-spacing: 0.8px; text-transform: uppercase; white-space: nowrap; }
        tbody tr { border-bottom: 1px solid rgba(255,255,255,0.04); transition: background 0.15s; }
        tbody tr:last-child { border-bottom: none; }
        tbody tr:hover { background: rgba(255,255,255,0.03); }
        td { padding: 14px 18px; font-size: 13.5px; vertical-align: middle; }

        /* Alat photo thumb */
        .alat-thumb { width: 52px; height: 52px; border-radius: 10px; object-fit: cover; border: 1px solid rgba(255,255,255,0.10); }
        .alat-thumb-placeholder { width: 52px; height: 52px; border-radius: 10px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.08); display: flex; align-items: center; justify-content: center; font-size: 20px; color: var(--muted); }
        .alat-info { display: flex; align-items: center; gap: 14px; }
        .alat-name { font-weight: 600; color: #fff; font-size: 14px; }
        .alat-time { font-size: 12px; color: var(--muted); margin-top: 2px; }

        .badge { display: inline-flex; align-items: center; gap: 5px; padding: 4px 11px; border-radius: 20px; font-size: 11.5px; font-weight: 700; letter-spacing: 0.3px; }
        .badge-kat { background: rgba(100,116,139,0.2); color: #94a3b8; }
        .badge-baik  { background: rgba(16,185,129,0.15); color: #34d399; }
        .badge-rusak { background: rgba(239,68,68,0.15);  color: #f87171; }

        .action-row { display: flex; gap: 8px; align-items: center; }
        .btn-sm { padding: 7px 14px; border-radius: 8px; font-family: inherit; font-size: 12px; font-weight: 600; cursor: pointer; transition: 0.2s; border: none; display: flex; align-items: center; gap: 5px; text-decoration: none; }
        .btn-sm-edit  { background: rgba(245,158,11,0.15); color: #fbbf24; }
        .btn-sm-edit:hover  { background: rgba(245,158,11,0.25); }
        .btn-sm-del   { background: rgba(239,68,68,0.12);  color: #f87171; }
        .btn-sm-del:hover   { background: rgba(239,68,68,0.22); }

        .empty-row td { text-align: center; padding: 60px; color: var(--muted); }
        .empty-icon { font-size: 40px; display: block; margin-bottom: 12px; }

        .pagination-wrap { padding: 16px 24px; border-top: 1px solid rgba(255,255,255,0.06); }
        .pagination-wrap .pagination { display: flex; gap: 4px; list-style: none; }
        .pagination-wrap .page-link { display: flex; align-items: center; justify-content: center; width: 34px; height: 34px; border-radius: 8px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.08); color: var(--muted); text-decoration: none; font-size: 13px; font-weight: 600; transition: 0.2s; }
        .pagination-wrap .page-link:hover { background: rgba(26,86,219,0.15); color: #fff; }
        .pagination-wrap .active .page-link { background: rgba(26,86,219,0.3); border-color: rgba(26,86,219,0.5); color: #fff; }
    </style>
</head>
<body>
    <aside class="sidebar">
        <div class="sidebar-brand">
            <div class="brand-row">
                <div class="brand-logo">🔧</div>
                <div><div class="brand-name">SiPinjamAlat</div><div class="brand-role">Administrator</div></div>
            </div>
        </div>
        <nav class="sidebar-nav">
            <div class="nav-section-label">Menu Utama</div>
            <a href="{{ route('admin.dashboard') }}" class="nav-item"><i class="fa-solid fa-gauge-high"></i> Dashboard</a>
            <a href="{{ route('admin.alat.index') }}" class="nav-item active"><i class="fa-solid fa-screwdriver-wrench"></i> Kelola Alat</a>
            <a href="{{ route('admin.peminjaman') }}" class="nav-item"><i class="fa-solid fa-boxes-stacked"></i> Peminjaman</a>
            <a href="{{ route('admin.users') }}" class="nav-item"><i class="fa-solid fa-users"></i> Kelola User</a>
            <div class="nav-section-label">Laporan</div>
            <a href="{{ route('admin.laporan.index') }}" class="nav-item"><i class="fa-solid fa-chart-bar"></i> Laporan</a>
        </nav>
        <div class="sidebar-footer">
            <div class="user-card">
                <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                <div><div class="user-name">{{ auth()->user()->name }}</div><div class="user-email">Admin</div></div>
            </div>
            <form method="POST" action="/logout">@csrf
                <button type="submit" class="btn-logout"><i class="fa-solid fa-right-from-bracket"></i> Logout</button>
            </form>
        </div>
    </aside>

    <main class="main-content">
        <div class="page-header">
            <div class="page-title">🔧 Kelola Alat</div>
            <a href="{{ route('admin.alat.create') }}" class="btn-add">
                <i class="fa-solid fa-plus"></i> Tambah Alat
            </a>
        </div>

        <div class="content-body">
            @if(session('success'))
                <div class="alert-success"><i class="fa-solid fa-circle-check"></i> {{ session('success') }}</div>
            @endif

            <!-- Filter -->
            <form method="GET" action="{{ route('admin.alat.index') }}">
                <div class="filter-card">
                    <div class="filter-row">
                        <div class="filter-input-wrap">
                            <i class="fa-solid fa-magnifying-glass filter-icon"></i>
                            <input type="text" name="search" class="filter-input"
                                   placeholder="Cari nama alat atau kategori..." value="{{ request('search') }}">
                        </div>
                        <div style="position:relative">
                            <select name="kategori" class="filter-input">
                                <option value="">Semua Kategori</option>
                                @foreach($kategoris as $kat)
                                    <option value="{{ $kat }}" {{ request('kategori')==$kat?'selected':'' }}>{{ $kat }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div style="position:relative">
                            <select name="kondisi" class="filter-input">
                                <option value="">Semua Kondisi</option>
                                <option value="Baik"  {{ request('kondisi')=='Baik' ?'selected':'' }}>Baik</option>
                                <option value="Rusak" {{ request('kondisi')=='Rusak'?'selected':'' }}>Rusak</option>
                            </select>
                        </div>
                        <button type="submit" class="btn-filter"><i class="fa-solid fa-filter"></i> Filter</button>
                        <a href="{{ route('admin.alat.index') }}" class="btn-reset"><i class="fa-solid fa-xmark"></i> Reset</a>
                    </div>
                </div>
            </form>

            <!-- Table -->
            <div class="table-card">
                <div class="table-scroll">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Foto</th>
                                <th>Nama Alat</th>
                                <th>Kategori</th>
                                <th>Kondisi</th>
                                <th>Ditambahkan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($alats as $i => $a)
                            <tr>
                                <td style="color:var(--muted);font-size:12px">{{ $alats->firstItem() + $i }}</td>
                                <td>
                                    @if($a->foto)
                                        <img src="{{ asset('storage/' . $a->foto) }}" class="alat-thumb" alt="{{ $a->nama_alat }}">
                                    @else
                                        <div class="alat-thumb-placeholder">🔧</div>
                                    @endif
                                </td>
                                <td>
                                    <div class="alat-name">{{ $a->nama_alat }}</div>
                                    <div class="alat-time">{{ $a->created_at->diffForHumans() }}</div>
                                </td>
                                <td><span class="badge badge-kat">{{ $a->kategori }}</span></td>
                                <td>
                                    @php $k = strtolower($a->kondisi ?? 'baik'); @endphp
                                    <span class="badge badge-{{ $k }}">
                                        {{ $k == 'baik' ? '✅ Baik' : '🔴 Rusak' }}
                                    </span>
                                </td>
                                <td style="color:var(--muted);font-size:12.5px">{{ $a->created_at->format('d M Y') }}</td>
                                <td>
                                    <div class="action-row">
                                        <a href="{{ route('admin.alat.edit', $a->id) }}" class="btn-sm btn-sm-edit">
                                            <i class="fa-solid fa-pen"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.alat.destroy', $a->id) }}" method="POST"
                                              onsubmit="return confirm('Yakin hapus alat ini?')">
                                            @csrf @method('DELETE')
                                            <button class="btn-sm btn-sm-del" type="submit">
                                                <i class="fa-solid fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr class="empty-row">
                                <td colspan="7">
                                    <span class="empty-icon">🔍</span>
                                    Tidak ada data alat ditemukan.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($alats->hasPages())
                <div class="pagination-wrap">{{ $alats->links() }}</div>
                @endif
            </div>
        </div>
    </main>
</body>
</html>