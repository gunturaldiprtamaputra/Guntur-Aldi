<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - SMK Kiansantang</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; }
        .sidebar-gradient { background: linear-gradient(180deg, #1e3a8a 0%, #1e40af 100%); }
        .nav-active { background: rgba(255,255,255,0.15); border-left: 3px solid #93c5fd !important; }
        .nav-item { border-left: 3px solid transparent; transition: all 0.18s; }
        .nav-item:hover { background: rgba(255,255,255,0.07); border-left-color: rgba(147,197,253,0.4); }
        .stat-card { transition: transform .2s, box-shadow .2s; }
        .stat-card:hover { transform: translateY(-2px); box-shadow: 0 10px 30px rgba(0,0,0,.08); }
        ::-webkit-scrollbar { width: 4px; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        @keyframes fadeUp { from { opacity:0; transform:translateY(12px); } to { opacity:1; transform:translateY(0); } }
        .fade-up { animation: fadeUp 0.45s ease forwards; }
        .d1{animation-delay:.05s;opacity:0} .d2{animation-delay:.1s;opacity:0}
        .d3{animation-delay:.15s;opacity:0} .d4{animation-delay:.2s;opacity:0}
        .d5{animation-delay:.25s;opacity:0} .d6{animation-delay:.3s;opacity:0}
    </style>
</head>
<body class="bg-gray-50 flex h-screen overflow-hidden">

{{-- ============================================================ SIDEBAR --}}
<aside class="w-64 sidebar-gradient text-white flex-shrink-0 flex flex-col shadow-xl z-30">

    <div class="p-5 flex items-center space-x-3 border-b border-white/10">
        <div class="bg-white/15 p-2 rounded-xl">
            <i class="fas fa-book-reader text-blue-200 text-xl"></i>
        </div>
        <div>
            <span class="font-bold text-sm tracking-wide block leading-tight">SMK KIASANTANG</span>
            <span class="text-blue-300 text-[10px] uppercase tracking-widest">Sistem Gudang</span>
        </div>
    </div>

    <nav class="flex-1 px-3 py-4 space-y-0.5 overflow-y-auto">

        <a href="{{ route('dashboard') }}"
           class="nav-item nav-active flex items-center space-x-3 px-4 py-3 rounded-xl">
            <i class="fas fa-chart-line w-4 text-sm text-blue-200 text-center"></i>
            <span class="text-sm font-semibold">Dashboard</span>
        </a>

        @if(Auth::user()->role == 'admin')
        <p class="px-3 pt-4 pb-1.5 text-[9px] font-bold text-blue-300/60 uppercase tracking-widest">Admin Menu</p>

        <a href="{{ route('anggota.index') }}"
           class="nav-item flex items-center space-x-3 px-4 py-3 rounded-xl text-blue-100 hover:text-white">
            <i class="fas fa-users w-4 text-sm text-center"></i>
            <span class="text-sm">Kelola Anggota</span>
        </a>

        <a href="{{ route('alat.index') }}"
           class="nav-item flex items-center space-x-3 px-4 py-3 rounded-xl text-blue-100 hover:text-white">
            <i class="fas fa-tools w-4 text-sm text-center"></i>
            <span class="text-sm">Inventaris Alat</span>
        </a>

        <a href="{{ route('peminjaman.index') }}"
           class="nav-item flex items-center space-x-3 px-4 py-3 rounded-xl text-blue-100 hover:text-white">
            <i class="fas fa-hand-holding w-4 text-sm text-center"></i>
            <span class="text-sm">Peminjaman</span>
        </a>

        <a href="{{ route('laporan.index') }}"
           class="nav-item flex items-center justify-between px-4 py-3 rounded-xl text-blue-100 hover:text-white">
            <span class="flex items-center space-x-3">
                <i class="fas fa-file-alt w-4 text-sm text-center"></i>
                <span class="text-sm">Laporan & Rekap</span>
            </span>
            <span class="bg-blue-400/25 text-blue-200 text-[9px] px-1.5 py-0.5 rounded font-bold">BARU</span>
        </a>
        @endif

        <p class="px-3 pt-4 pb-1.5 text-[9px] font-bold text-blue-300/60 uppercase tracking-widest">Menu Utama</p>

        <a href="{{ route('koleksi.index') }}"
           class="nav-item flex items-center space-x-3 px-4 py-3 rounded-xl text-blue-100 hover:text-white">
            <i class="fas fa-search w-4 text-sm text-center"></i>
            <span class="text-sm">Cari Koleksi</span>
        </a>

        <a href="{{ route('riwayat.index') }}"
           class="nav-item flex items-center space-x-3 px-4 py-3 rounded-xl text-blue-100 hover:text-white">
            <i class="fas fa-history w-4 text-sm text-center"></i>
            <span class="text-sm">Riwayat Pinjam</span>
        </a>
    </nav>

    <div class="p-3 border-t border-white/10">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit"
                    class="w-full flex items-center justify-center space-x-2 p-2.5 rounded-xl transition-all
                           bg-red-500/10 hover:bg-red-500 border border-red-500/20 text-red-300 hover:text-white text-sm">
                <i class="fas fa-sign-out-alt"></i>
                <span>Keluar</span>
            </button>
        </form>
    </div>
</aside>

{{-- ============================================================ MAIN --}}
<main class="flex-1 overflow-y-auto">

    {{-- HEADER --}}
    <header class="bg-white border-b border-gray-200 px-6 py-4 sticky top-0 z-20 shadow-sm
                   flex justify-between items-center">
        <div>
            <h1 class="text-lg font-bold text-gray-800">Dashboard Overview</h1>
            <p class="text-xs text-gray-400">{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</p>
        </div>
        <div class="flex items-center gap-3">
            @if(isset($peminjaman_terlambat) && $peminjaman_terlambat > 0)
            <a href="{{ route('laporan.index') }}?status=terlambat"
               class="flex items-center gap-1.5 bg-red-50 border border-red-200 text-red-600
                      px-3 py-1.5 rounded-lg text-xs font-semibold hover:bg-red-100 transition-colors">
                <i class="fas fa-exclamation-triangle text-xs animate-pulse"></i>
                <span>{{ $peminjaman_terlambat }} Terlambat</span>
            </a>
            @endif

            <div class="flex items-center gap-2.5 bg-gray-50 border border-gray-200 rounded-xl px-3 py-2">
                <div class="h-9 w-9 rounded-lg bg-gradient-to-br from-blue-600 to-blue-800
                            flex items-center justify-center text-white font-bold text-sm shadow-sm">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <div>
                    <p class="text-sm font-bold text-gray-800 leading-tight">{{ $user->name }}</p>
                    <p class="text-[10px] text-blue-600 uppercase font-bold tracking-wider">{{ $user->role }}</p>
                </div>
            </div>
        </div>
    </header>

    <div class="p-6 space-y-5">

        {{-- WELCOME BANNER --}}
        <div class="fade-up d1 bg-gradient-to-r from-blue-900 via-blue-800 to-blue-700 rounded-2xl p-6
                    text-white relative overflow-hidden shadow-lg">
            <div class="absolute right-6 top-0 bottom-0 flex items-center opacity-[0.07] pointer-events-none select-none">
                <i class="fas fa-warehouse text-[130px]"></i>
            </div>
            <div class="relative z-10 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-bold">Selamat Datang, {{ $user->name }}! 👋</h2>
                    <p class="text-blue-200 text-sm mt-1">Berikut adalah ringkasan laporan sistem Gudang hari ini.</p>
                </div>
                @if(Auth::user()->role == 'admin')
                <a href="{{ route('laporan.index') }}"
                   class="flex-shrink-0 flex items-center gap-2 bg-white/15 hover:bg-white/25
                          border border-white/20 px-4 py-2.5 rounded-xl text-sm font-semibold transition-all">
                    <i class="fas fa-file-alt"></i>
                    <span>Buat Laporan</span>
                </a>
                @endif
            </div>
        </div>

        {{-- STAT CARDS --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="stat-card fade-up d2 bg-white rounded-2xl p-5 border border-gray-100 shadow-sm
                        flex items-center gap-4 border-l-4 border-l-blue-600">
                <div class="bg-blue-100 p-3.5 rounded-xl shrink-0">
                    <i class="fas fa-boxes text-blue-600 text-xl"></i>
                </div>
                <div>
                    <p class="text-xs text-gray-500 font-medium">Total Koleksi</p>
                    <p class="text-2xl font-bold text-gray-800">{{ number_format($total_buku) }}</p>
                    <p class="text-[10px] text-gray-400 mt-0.5">unit / item</p>
                </div>
            </div>

            <div class="stat-card fade-up d3 bg-white rounded-2xl p-5 border border-gray-100 shadow-sm
                        flex items-center gap-4 border-l-4 border-l-green-500">
                <div class="bg-green-100 p-3.5 rounded-xl shrink-0">
                    <i class="fas fa-user-graduate text-green-600 text-xl"></i>
                </div>
                <div>
                    <p class="text-xs text-gray-500 font-medium">Total Anggota</p>
                    <p class="text-2xl font-bold text-gray-800">{{ number_format($total_anggota) }}</p>
                    <p class="text-[10px] text-gray-400 mt-0.5">terdaftar</p>
                </div>
            </div>

            <div class="stat-card fade-up d4 bg-white rounded-2xl p-5 border border-gray-100 shadow-sm
                        flex items-center gap-4 border-l-4 border-l-purple-500">
                <div class="bg-purple-100 p-3.5 rounded-xl shrink-0">
                    <i class="fas fa-exchange-alt text-purple-600 text-xl"></i>
                </div>
                <div>
                    <p class="text-xs text-gray-500 font-medium">Peminjaman Aktif</p>
                    <p class="text-2xl font-bold text-gray-800">{{ number_format($peminjaman_aktif) }}</p>
                    <p class="text-[10px] text-gray-400 mt-0.5">sedang dipinjam</p>
                </div>
            </div>

            <div class="stat-card fade-up d5 bg-white rounded-2xl p-5 border border-gray-100 shadow-sm
                        flex items-center gap-4 border-l-4 border-l-red-500">
                <div class="bg-red-100 p-3.5 rounded-xl shrink-0">
                    <i class="fas fa-clock text-red-500 text-xl"></i>
                </div>
                <div>
                    <p class="text-xs text-gray-500 font-medium">Terlambat</p>
                    <p class="text-2xl font-bold {{ ($peminjaman_terlambat ?? 0) > 0 ? 'text-red-500' : 'text-gray-800' }}">
                        {{ number_format($peminjaman_terlambat ?? 0) }}
                    </p>
                    <p class="text-[10px] text-red-400 mt-0.5">lewat batas waktu</p>
                </div>
            </div>
        </div>

        {{-- CHARTS --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

            {{-- Bar Chart Peminjaman --}}
            <div class="fade-up d5 lg:col-span-2 bg-white rounded-2xl p-5 border border-gray-100 shadow-sm">
                <div class="flex justify-between items-start mb-5">
                    <div>
                        <h3 class="font-bold text-gray-800">Grafik Peminjaman</h3>
                        <p class="text-xs text-gray-400 mt-0.5">Aktivitas pinjam & kembali 6 bulan terakhir</p>
                    </div>
                    <div class="flex items-center gap-3 text-xs text-gray-500">
                        <span class="flex items-center gap-1.5">
                            <span class="w-2.5 h-2.5 rounded-full bg-blue-500 inline-block"></span>Pinjam
                        </span>
                        <span class="flex items-center gap-1.5">
                            <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 inline-block"></span>Kembali
                        </span>
                    </div>
                </div>
                <canvas id="chartPeminjaman" height="115"></canvas>
            </div>

            {{-- Donut Chart Status Alat --}}
            <div class="fade-up d6 bg-white rounded-2xl p-5 border border-gray-100 shadow-sm">
                <h3 class="font-bold text-gray-800">Status Alat</h3>
                <p class="text-xs text-gray-400 mt-0.5 mb-4">Kondisi inventaris saat ini</p>
                <div class="flex justify-center mb-4">
                    <canvas id="chartStatus" width="160" height="160"></canvas>
                </div>
                <div class="space-y-2.5">
                    <div class="flex justify-between items-center">
                        <span class="flex items-center gap-2 text-xs text-gray-600">
                            <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 inline-block"></span>Tersedia
                        </span>
                        <span class="text-xs font-bold text-gray-800">{{ $alat_tersedia ?? 0 }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="flex items-center gap-2 text-xs text-gray-600">
                            <span class="w-2.5 h-2.5 rounded-full bg-blue-400 inline-block"></span>Dipinjam
                        </span>
                        <span class="text-xs font-bold text-gray-800">{{ $alat_dipinjam ?? 0 }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="flex items-center gap-2 text-xs text-gray-600">
                            <span class="w-2.5 h-2.5 rounded-full bg-red-400 inline-block"></span>Rusak / Servis
                        </span>
                        <span class="text-xs font-bold text-gray-800">{{ $alat_rusak ?? 0 }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- AKTIVITAS + PANEL KANAN --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

            {{-- Tabel Aktivitas --}}
            <div class="lg:col-span-2 bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="flex justify-between items-center px-5 py-4 border-b border-gray-100">
                    <h3 class="font-bold text-gray-800">
                        <i class="fas fa-clock text-blue-500 mr-2"></i>Aktivitas Terbaru
                    </h3>
                    <a href="{{ route('peminjaman.index') }}"
                       class="text-xs text-blue-600 hover:underline font-semibold">Lihat Semua →</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="bg-gray-50 text-gray-500 text-xs font-bold uppercase">
                            <tr>
                                <th class="px-5 py-3">Nama Anggota</th>
                                <th class="px-5 py-3">Alat / Koleksi</th>
                                <th class="px-5 py-3">Aksi</th>
                                <th class="px-5 py-3">Waktu</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($aktivitas_terbaru ?? [] as $item)
                            <tr class="hover:bg-gray-50/70 transition-colors">
                                <td class="px-5 py-3.5">
                                    <div class="flex items-center gap-2.5">
                                        <div class="h-7 w-7 rounded-lg bg-blue-100 flex items-center
                                                    justify-center text-blue-700 font-bold text-xs shrink-0">
                                            {{ strtoupper(substr($item->anggota->name ?? 'U', 0, 1)) }}
                                        </div>
                                        <span class="font-medium text-gray-800 text-sm">{{ $item->anggota->name ?? '-' }}</span>
                                    </div>
                                </td>
                                <td class="px-5 py-3.5 text-gray-500 text-xs">
                                    {{ $item->alat->nama_alat ?? $item->koleksi->nama ?? '-' }}
                                </td>
                                <td class="px-5 py-3.5">
                                    @if($item->status == 'dipinjam')
                                        <span class="bg-green-100 text-green-700 text-xs px-2.5 py-1 rounded-lg font-semibold">Pinjam</span>
                                    @elseif($item->status == 'dikembalikan')
                                        <span class="bg-blue-100 text-blue-700 text-xs px-2.5 py-1 rounded-lg font-semibold">Kembali</span>
                                    @elseif($item->status == 'terlambat')
                                        <span class="bg-red-100 text-red-700 text-xs px-2.5 py-1 rounded-lg font-semibold">Terlambat</span>
                                    @else
                                        <span class="bg-purple-100 text-purple-700 text-xs px-2.5 py-1 rounded-lg font-semibold">{{ ucfirst($item->status ?? '') }}</span>
                                    @endif
                                </td>
                                <td class="px-5 py-3.5 text-gray-400 text-xs whitespace-nowrap">
                                    {{ $item->created_at->diffForHumans() }}
                                </td>
                            </tr>
                            @empty
                            {{-- DATA DUMMY saat kosong --}}
                            <tr>
                                <td class="px-5 py-3.5">
                                    <div class="flex items-center gap-2.5">
                                        <div class="h-7 w-7 rounded-lg bg-blue-100 flex items-center justify-center text-blue-700 font-bold text-xs">B</div>
                                        <span class="font-medium text-gray-800 text-sm">Budi Santoso</span>
                                    </div>
                                </td>
                                <td class="px-5 py-3.5 text-gray-500 text-xs">Obeng Set</td>
                                <td class="px-5 py-3.5">
                                    <span class="bg-green-100 text-green-700 text-xs px-2.5 py-1 rounded-lg font-semibold">Pinjam</span>
                                </td>
                                <td class="px-5 py-3.5 text-gray-400 text-xs">10 menit yang lalu</td>
                            </tr>
                            <tr>
                                <td class="px-5 py-3.5">
                                    <div class="flex items-center gap-2.5">
                                        <div class="h-7 w-7 rounded-lg bg-green-100 flex items-center justify-center text-green-700 font-bold text-xs">A</div>
                                        <span class="font-medium text-gray-800 text-sm">Ani Wijaya</span>
                                    </div>
                                </td>
                                <td class="px-5 py-3.5 text-gray-500 text-xs">Multimeter</td>
                                <td class="px-5 py-3.5">
                                    <span class="bg-blue-100 text-blue-700 text-xs px-2.5 py-1 rounded-lg font-semibold">Kembali</span>
                                </td>
                                <td class="px-5 py-3.5 text-gray-400 text-xs">1 jam yang lalu</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Panel Kanan --}}
            <div class="space-y-4">
                {{-- Quick Actions - Admin Only --}}
                @if(Auth::user()->role == 'admin')
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                    <h3 class="font-bold text-gray-800 mb-3">
                        <i class="fas fa-bolt text-yellow-500 mr-2"></i>Aksi Cepat
                    </h3>
                    <div class="grid grid-cols-2 gap-2.5">
                        <a href="{{ route('peminjaman.create') }}"
                           class="flex flex-col items-center p-3.5 bg-blue-50 hover:bg-blue-100 border border-blue-100 rounded-xl transition-all group">
                            <i class="fas fa-plus-circle text-blue-600 text-xl mb-1.5 group-hover:scale-110 transition-transform"></i>
                            <span class="text-[11px] font-semibold text-blue-700 text-center leading-tight">Tambah Pinjaman</span>
                        </a>
                        <a href="{{ route('anggota.create') }}"
                           class="flex flex-col items-center p-3.5 bg-green-50 hover:bg-green-100 border border-green-100 rounded-xl transition-all group">
                            <i class="fas fa-user-plus text-green-600 text-xl mb-1.5 group-hover:scale-110 transition-transform"></i>
                            <span class="text-[11px] font-semibold text-green-700 text-center leading-tight">Daftar Anggota</span>
                        </a>
                        <a href="{{ route('alat.create') }}"
                           class="flex flex-col items-center p-3.5 bg-purple-50 hover:bg-purple-100 border border-purple-100 rounded-xl transition-all group">
                            <i class="fas fa-tools text-purple-600 text-xl mb-1.5 group-hover:scale-110 transition-transform"></i>
                            <span class="text-[11px] font-semibold text-purple-700 text-center leading-tight">Tambah Alat</span>
                        </a>
                        <a href="{{ route('laporan.index') }}"
                           class="flex flex-col items-center p-3.5 bg-orange-50 hover:bg-orange-100 border border-orange-100 rounded-xl transition-all group">
                            <i class="fas fa-file-alt text-orange-500 text-xl mb-1.5 group-hover:scale-110 transition-transform"></i>
                            <span class="text-[11px] font-semibold text-orange-700 text-center leading-tight">Cetak Laporan</span>
                        </a>
                    </div>
                </div>
                @endif

                {{-- Jatuh Tempo Hari Ini --}}
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                    <div class="px-5 py-3.5 border-b border-gray-100 flex justify-between items-center">
                        <h3 class="font-bold text-gray-800 text-sm">
                            <i class="fas fa-calendar-times text-red-400 mr-2"></i>Jatuh Tempo Hari Ini
                        </h3>
                        <span class="bg-red-100 text-red-600 text-xs font-bold px-2 py-0.5 rounded-full">
                            {{ count($jatuh_tempo ?? []) }}
                        </span>
                    </div>
                    <div class="divide-y divide-gray-50">
                        @forelse($jatuh_tempo ?? [] as $jt)
                        <div class="px-4 py-3 flex items-center justify-between hover:bg-gray-50 transition-colors">
                            <div>
                                <p class="text-xs font-semibold text-gray-800">{{ $jt->anggota->name ?? '-' }}</p>
                                <p class="text-[10px] text-gray-400 mt-0.5">{{ $jt->alat->nama_alat ?? '-' }}</p>
                            </div>
                            <span class="text-[10px] bg-red-100 text-red-600 px-2 py-1 rounded-lg font-semibold">
                                {{ \Carbon\Carbon::parse($jt->tanggal_kembali)->format('d/m') }}
                            </span>
                        </div>
                        @empty
                        <div class="px-4 py-6 text-center text-xs text-gray-400">
                            <i class="fas fa-check-circle text-green-400 text-xl mb-1.5 block"></i>
                            Tidak ada yang jatuh tempo hari ini
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

    </div>{{-- end p-6 --}}
</main>

<script>
// Chart Peminjaman Bulanan (Bar)
new Chart(document.getElementById('chartPeminjaman'), {
    type: 'bar',
    data: {
        labels: {!! json_encode($chart_labels ?? ['Jan','Feb','Mar','Apr','Mei','Jun']) !!},
        datasets: [
            {
                label: 'Pinjam',
                data: {!! json_encode($chart_pinjam ?? [5,8,12,7,9,12]) !!},
                backgroundColor: 'rgba(59,130,246,0.85)',
                borderRadius: 6,
                borderSkipped: false,
            },
            {
                label: 'Kembali',
                data: {!! json_encode($chart_kembali ?? [4,7,11,6,8,10]) !!},
                backgroundColor: 'rgba(52,211,153,0.85)',
                borderRadius: 6,
                borderSkipped: false,
            }
        ]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: {
            x: { grid: { display: false }, border: { display: false } },
            y: { grid: { color: 'rgba(0,0,0,0.04)' }, border: { display: false }, ticks: { stepSize: 2 } }
        }
    }
});

// Chart Status Alat (Donut)
new Chart(document.getElementById('chartStatus'), {
    type: 'doughnut',
    data: {
        labels: ['Tersedia', 'Dipinjam', 'Rusak'],
        datasets: [{
            data: [
                {{ $alat_tersedia ?? 80 }},
                {{ $alat_dipinjam ?? 12 }},
                {{ $alat_rusak ?? 8 }}
            ],
            backgroundColor: ['#34d399','#60a5fa','#f87171'],
            borderWidth: 3,
            borderColor: '#fff',
        }]
    },
    options: {
        cutout: '68%',
        plugins: { legend: { display: false } },
        responsive: false
    }
});
</script>

</body>
</html>
