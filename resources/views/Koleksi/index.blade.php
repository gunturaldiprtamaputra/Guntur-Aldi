<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cari & Pinjam Alat — SiPinjamAlat</title>
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
        .alert-error   { background: rgba(239,68,68,0.1);  color: #dc2626; border: 1px solid rgba(239,68,68,0.2); }

        /* SEARCH */
        .search-bar { background: #fff; border-radius: 14px; padding: 18px 20px; box-shadow: 0 1px 3px rgba(0,0,0,0.07); border: 1px solid #f1f5f9; margin-bottom: 24px; display: flex; gap: 12px; }
        .search-bar input { flex: 1; padding: 10px 14px; border: 1.5px solid #e2e8f0; border-radius: 10px; font-family: inherit; font-size: 14px; color: #0f172a; outline: none; transition: border-color 0.2s; }
        .search-bar input:focus { border-color: #1a56db; box-shadow: 0 0 0 3px rgba(26,86,219,0.1); }

        /* GRID ALAT */
        .alat-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 20px; }
        .alat-card { background: #fff; border-radius: 16px; padding: 22px; box-shadow: 0 1px 3px rgba(0,0,0,0.07); border: 1px solid #f1f5f9; transition: all 0.2s; }
        .alat-card:hover { box-shadow: 0 8px 24px rgba(0,0,0,0.1); transform: translateY(-2px); }
        .alat-icon { width: 52px; height: 52px; background: rgba(26,86,219,0.1); border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 22px; margin-bottom: 14px; color: #1a56db; }
        .alat-name { font-size: 16px; font-weight: 700; color: #0f172a; margin-bottom: 4px; }
        .alat-kategori { font-size: 12px; color: #94a3b8; margin-bottom: 12px; }
        .alat-meta { display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; }
        .stok-info { font-size: 13px; color: #64748b; }
        .stok-info strong { color: #0f172a; }
        .badge { display: inline-flex; align-items: center; padding: 3px 10px; border-radius: 20px; font-size: 11.5px; font-weight: 600; }
        .badge-green { background: rgba(16,185,129,0.1); color: #059669; }
        .badge-red   { background: rgba(239,68,68,0.1);  color: #dc2626; }

        /* MODAL */
        .modal-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 200; align-items: center; justify-content: center; }
        .modal-overlay.show { display: flex; }
        .modal { background: #fff; border-radius: 20px; padding: 28px; width: 100%; max-width: 440px; margin: 16px; }
        .modal-title { font-size: 18px; font-weight: 700; color: #0f172a; margin-bottom: 6px; }
        .modal-subtitle { font-size: 13px; color: #64748b; margin-bottom: 22px; }
        .form-group { margin-bottom: 16px; }
        .form-group label { display: block; font-size: 12px; font-weight: 600; color: #64748b; margin-bottom: 6px; }
        .form-group input { width: 100%; padding: 10px 14px; border: 1.5px solid #e2e8f0; border-radius: 10px; font-family: inherit; font-size: 14px; color: #0f172a; outline: none; transition: border-color 0.2s; }
        .form-group input:focus { border-color: #1a56db; box-shadow: 0 0 0 3px rgba(26,86,219,0.1); }
        .modal-info { background: #f8fafc; border-radius: 10px; padding: 12px 14px; margin-bottom: 20px; font-size: 13px; color: #475569; }
        .modal-info strong { color: #0f172a; display: block; font-size: 15px; margin-bottom: 2px; }
        .modal-actions { display: flex; gap: 10px; }

        /* BUTTONS */
        .btn { padding: 10px 18px; border: none; border-radius: 10px; font-family: inherit; font-size: 13.5px; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; justify-content: center; gap: 6px; transition: all 0.2s; text-decoration: none; width: 100%; }
        .btn-primary { background: linear-gradient(135deg, #1a56db, #1e429f); color: #fff; box-shadow: 0 4px 12px rgba(26,86,219,0.3); }
        .btn-primary:hover { transform: translateY(-1px); box-shadow: 0 6px 16px rgba(26,86,219,0.4); }
        .btn-primary:disabled { background: #94a3b8; box-shadow: none; cursor: not-allowed; transform: none; }
        .btn-ghost { background: #f1f5f9; color: #64748b; border: 1px solid #e2e8f0; }
        .btn-ghost:hover { background: #e2e8f0; }

        .empty-state { text-align: center; padding: 60px; color: #94a3b8; grid-column: 1/-1; }
        .empty-state i { font-size: 48px; margin-bottom: 14px; display: block; }
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
        <a class="nav-item active" href="{{ route('koleksi.index') }}">
            <i class="fa-solid fa-magnifying-glass"></i> Cari Alat
        </a>
        <a class="nav-item" href="{{ route('riwayat.index') }}">
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
        <div class="topbar-title">Cari & Pinjam Alat</div>
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
        @if(session('error'))
        <div class="alert alert-error">
            <i class="fa-solid fa-circle-xmark"></i> {{ session('error') }}
        </div>
        @endif

        {{-- SEARCH --}}
        <div class="search-bar">
            <input type="text" id="searchInput" placeholder="🔍  Cari nama alat..." oninput="filterAlat()">
        </div>

        {{-- GRID --}}
        <div class="alat-grid" id="alatGrid">
            @forelse($alats as $alat)
            <div class="alat-card" data-nama="{{ strtolower($alat->nama_alat) }}">
                <div class="alat-icon"><i class="fa-solid fa-toolbox"></i></div>
                <div class="alat-name">{{ $alat->nama_alat }}</div>
                <div class="alat-kategori">{{ $alat->kategori ?? 'Umum' }}</div>
                <div class="alat-meta">
                    <div class="stok-info">Stok: <strong>{{ $alat->stok }}</strong></div>
                    @if($alat->stok > 0)
                        <span class="badge badge-green">Tersedia</span>
                    @else
                        <span class="badge badge-red">Habis</span>
                    @endif
                </div>
                @if($alat->stok > 0)
                <button class="btn btn-primary"
                        onclick="bukaModal({{ $alat->id }}, '{{ addslashes($alat->nama_alat) }}', {{ $alat->stok }})">
                    <i class="fa-solid fa-handshake"></i> Pinjam Sekarang
                </button>
                @else
                <button class="btn btn-primary" disabled>
                    <i class="fa-solid fa-ban"></i> Stok Habis
                </button>
                @endif
            </div>
            @empty
            <div class="empty-state">
                <i class="fa-solid fa-box-open"></i>
                <strong>Belum ada alat tersedia</strong><br>
                <small>Silakan hubungi admin</small>
            </div>
            @endforelse
        </div>

    </div>
</div>

{{-- MODAL PINJAM --}}
<div class="modal-overlay" id="modalOverlay" onclick="tutupModal(event)">
    <div class="modal">
        <div class="modal-title">Formulir Peminjaman</div>
        <div class="modal-subtitle">Isi tanggal rencana pengembalian alat</div>

        <div class="modal-info">
            <strong id="modalNamaAlat">—</strong>
            Stok tersedia: <span id="modalStok">—</span> unit
        </div>

        <form action="{{ route('koleksi.pinjam') }}" method="POST">
            @csrf
            <input type="hidden" name="alat_id" id="modalAlatId">
            <div class="form-group">
                <label>Tanggal Rencana Kembali</label>
                <input type="date" name="tanggal_kembali" id="modalTanggal"
                       min="{{ date('Y-m-d', strtotime('+1 day')) }}" required>
            </div>
            <div class="modal-actions">
                <button type="button" class="btn btn-ghost" onclick="tutupModalLangsung()">
                    Batal
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-handshake"></i> Konfirmasi Pinjam
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function bukaModal(id, nama, stok) {
    document.getElementById('modalAlatId').value = id;
    document.getElementById('modalNamaAlat').textContent = nama;
    document.getElementById('modalStok').textContent = stok;
    document.getElementById('modalOverlay').classList.add('show');
}
function tutupModal(e) {
    if (e.target === document.getElementById('modalOverlay')) tutupModalLangsung();
}
function tutupModalLangsung() {
    document.getElementById('modalOverlay').classList.remove('show');
    document.getElementById('modalTanggal').value = '';
}
function filterAlat() {
    const q = document.getElementById('searchInput').value.toLowerCase();
    document.querySelectorAll('.alat-card').forEach(card => {
        card.style.display = card.dataset.nama.includes(q) ? '' : 'none';
    });
}
</script>

</body>
</html>