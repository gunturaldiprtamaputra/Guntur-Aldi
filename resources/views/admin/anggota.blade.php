<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Anggota — SiPinjamAlat</title>
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

        /* SECTION */
        .section-card { background: #fff; border-radius: 16px; box-shadow: 0 1px 3px rgba(0,0,0,0.07); border: 1px solid #f1f5f9; overflow: hidden; }
        .section-header { padding: 20px 24px; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; justify-content: space-between; }
        .section-title { font-size: 15px; font-weight: 700; color: #0f172a; display: flex; align-items: center; gap: 8px; }
        .section-title i { color: #1a56db; }
        .count-badge { background: rgba(26,86,219,0.1); color: #1a56db; font-size: 12px; font-weight: 700; padding: 3px 10px; border-radius: 20px; }

        /* BUTTONS */
        .btn { padding: 9px 16px; border: none; border-radius: 10px; font-family: inherit; font-size: 13px; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 6px; transition: all 0.2s; text-decoration: none; }
        .btn-primary { background: linear-gradient(135deg, #1a56db, #1e429f); color: #fff; box-shadow: 0 4px 12px rgba(26,86,219,0.3); }
        .btn-primary:hover { transform: translateY(-1px); }
        .btn-sm { padding: 6px 12px; font-size: 12px; border-radius: 8px; }
        .btn-warning { background: rgba(245,158,11,0.1); color: #d97706; border: 1px solid rgba(245,158,11,0.2); }
        .btn-warning:hover { background: rgba(245,158,11,0.2); }
        .btn-danger { background: rgba(239,68,68,0.1); color: #dc2626; border: 1px solid rgba(239,68,68,0.2); }
        .btn-danger:hover { background: rgba(239,68,68,0.2); }

        /* TABLE */
        table { width: 100%; border-collapse: collapse; }
        thead tr { background: #f8fafc; }
        th { padding: 11px 20px; text-align: left; font-size: 12px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 1px solid #e2e8f0; }
        td { padding: 14px 20px; font-size: 13.5px; color: #334155; border-bottom: 1px solid #f1f5f9; vertical-align: middle; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: #f8fafc; }

        .member-info { display: flex; align-items: center; gap: 12px; }
        .member-avatar { width: 38px; height: 38px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 14px; font-weight: 700; color: #fff; flex-shrink: 0; }
        .member-name { font-weight: 600; color: #0f172a; font-size: 14px; }
        .member-email { font-size: 12px; color: #94a3b8; margin-top: 2px; }

        .role-badge { display: inline-flex; align-items: center; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; }
        .role-admin { background: rgba(139,92,246,0.1); color: #7c3aed; }
        .role-user  { background: rgba(16,185,129,0.1); color: #059669; }

        .actions { display: flex; gap: 6px; }
        .table-footer { padding: 14px 20px; background: #f8fafc; border-top: 1px solid #e2e8f0; font-size: 12px; color: #64748b; display: flex; justify-content: space-between; align-items: center; }

        /* MODAL */
        .modal-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 200; align-items: center; justify-content: center; }
        .modal-overlay.show { display: flex; }
        .modal { background: #fff; border-radius: 20px; padding: 28px; width: 100%; max-width: 420px; margin: 16px; }
        .modal-title { font-size: 17px; font-weight: 700; color: #0f172a; margin-bottom: 20px; display: flex; align-items: center; gap: 8px; }
        .modal-title i { color: #1a56db; }
        .form-group { margin-bottom: 16px; }
        .form-group label { display: block; font-size: 12px; font-weight: 600; color: #64748b; margin-bottom: 6px; }
        .form-group input,
        .form-group select { width: 100%; padding: 10px 14px; border: 1.5px solid #e2e8f0; border-radius: 10px; font-family: inherit; font-size: 14px; color: #0f172a; outline: none; transition: border-color 0.2s; }
        .form-group input:focus,
        .form-group select:focus { border-color: #1a56db; box-shadow: 0 0 0 3px rgba(26,86,219,0.1); }
        .modal-actions { display: flex; gap: 10px; margin-top: 20px; }
        .btn-ghost { background: #f1f5f9; color: #64748b; border: 1px solid #e2e8f0; }
        .btn-ghost:hover { background: #e2e8f0; }

        .empty-state { text-align: center; padding: 60px; color: #94a3b8; }
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
            <div class="role">Admin Panel</div>
        </div>
    </div>
    <nav class="sidebar-nav">
        <div class="nav-label">Menu</div>
        <a class="nav-item" href="{{ route('admin.dashboard') }}">
            <i class="fa-solid fa-gauge"></i> Dashboard
        </a>
        <a class="nav-item" href="{{ route('peminjaman.index') }}">
            <i class="fa-solid fa-handshake"></i> Peminjaman
        </a>
        <a class="nav-item" href="{{ route('laporan.index') }}">
            <i class="fa-solid fa-file-lines"></i> Laporan
        </a>
        <a class="nav-item active" href="{{ route('anggota.index') }}">
            <i class="fa-solid fa-users"></i> Kelola Anggota
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
        <div class="topbar-title">Kelola Anggota</div>
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

        <div class="section-card">
            <div class="section-header">
                <div class="section-title">
                    <i class="fa-solid fa-users"></i> Daftar Anggota
                    <span class="count-badge">{{ $anggota->count() }} Anggota</span>
                </div>
                <button class="btn btn-primary" onclick="document.getElementById('modalTambah').classList.add('show')">
                    <i class="fa-solid fa-plus"></i> Tambah Anggota
                </button>
            </div>

            @if($anggota->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Info Anggota</th>
                        <th>Role</th>
                        <th>Tanggal Daftar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($anggota as $i => $a)
                    @php
                        $colors = ['#1a56db','#059669','#7c3aed','#d97706','#dc2626'];
                        $color  = $colors[$i % count($colors)];
                    @endphp
                    <tr>
                        <td style="color:#94a3b8; font-size:12px;">{{ $i + 1 }}</td>
                        <td>
                            <div class="member-info">
                                <div class="member-avatar" style="background: {{ $color }};">
                                    {{ strtoupper(substr($a->name, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="member-name">{{ $a->name }}</div>
                                    <div class="member-email">{{ $a->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            @if($a->role === 'admin')
                                <span class="role-badge role-admin"><i class="fa-solid fa-crown" style="font-size:10px;"></i> Admin</span>
                            @else
                                <span class="role-badge role-user"><i class="fa-solid fa-user" style="font-size:10px;"></i> Anggota</span>
                            @endif
                        </td>
                        <td style="color:#64748b; font-size:13px;">
                            {{ $a->created_at->format('d M Y') }}
                        </td>
                        <td>
                            <div class="actions">
                                <a href="{{ route('anggota.edit', $a->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fa-solid fa-pen"></i> Edit
                                </a>
                                <form action="{{ route('anggota.destroy', $a->id) }}" method="POST"
                                      onsubmit="return confirm('Hapus anggota ini?')">
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
            <div class="table-footer">
                <span>Menampilkan <strong>{{ $anggota->count() }}</strong> anggota</span>
            </div>
            @else
            <div class="empty-state">
                <i class="fa-solid fa-users"></i>
                Belum ada anggota terdaftar.
            </div>
            @endif
        </div>

    </div>
</div>

{{-- MODAL TAMBAH ANGGOTA --}}
<div class="modal-overlay" id="modalTambah" onclick="if(event.target===this)this.classList.remove('show')">
    <div class="modal">
        <div class="modal-title"><i class="fa-solid fa-user-plus"></i> Tambah Anggota Baru</div>
        <form action="{{ route('anggota.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="name" placeholder="Nama anggota" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="email@contoh.com" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Minimal 8 karakter" required>
            </div>
            <div class="form-group">
                <label>Role</label>
                <select name="role">
                    <option value="user">Anggota</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <div class="modal-actions">
                <button type="button" class="btn btn-ghost"
                        onclick="document.getElementById('modalTambah').classList.remove('show')">
                    Batal
                </button>
                <button type="submit" class="btn btn-primary" style="flex:1;">
                    <i class="fa-solid fa-user-plus"></i> Tambah Anggota
                </button>
            </div>
        </form>
    </div>
</div>

</body>
</html>