<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <title>Manajemen Anggota</title>
</head>
<body class="bg-gray-50 font-sans">

    <header class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-blue-600">Data <span class="text-gray-800">Anggota</span></h1>
                <p class="text-sm text-gray-500">SMK Kian Santang Inventory System</p>
            </div>
            <a href="#" class="flex items-center gap-2 px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition shadow-sm">
                <i class="fas fa-home text-blue-600"></i>
                <span class="font-medium">Dashboard</span>
            </a>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-6 py-10">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            
            <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center bg-white">
                <h2 class="text-lg font-semibold text-gray-800">Daftar Pengguna Aktif</h2>
                <span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs font-bold rounded-full">
                    2 Anggota
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 uppercase text-xs font-bold text-gray-500 tracking-wider">
                            <th class="px-6 py-4">Info Anggota</th>
                            <th class="px-6 py-4">Role</th>
                            <th class="px-6 py-4">Tanggal Join</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <tr class="hover:bg-blue-50/30 transition">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="h-10 w-10 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold">
                                        JD
                                    </div>
                                    <div>
                                        <div class="text-sm font-semibold text-gray-900">John Doe</div>
                                        <div class="text-xs text-gray-500">john@smkkiansantang.sch.id</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-0.5 rounded-md text-xs font-medium bg-purple-100 text-purple-700 border border-purple-200">
                                    Administrator
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                20 April 2026
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center gap-2">
                                    <button class="p-2 text-gray-400 hover:text-blue-600 transition"><i class="fas fa-edit"></i></button>
                                    <button class="p-2 text-gray-400 hover:text-red-600 transition"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>

                        <tr class="hover:bg-blue-50/30 transition">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="h-10 w-10 rounded-full bg-emerald-500 flex items-center justify-center text-white font-bold">
                                        SA
                                    </div>
                                    <div>
                                        <div class="text-sm font-semibold text-gray-900">Siti Aminah</div>
                                        <div class="text-xs text-gray-500">siti@smkkiansantang.sch.id</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-0.5 rounded-md text-xs font-medium bg-blue-100 text-blue-700 border border-blue-200">
                                    Petugas
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                22 April 2026
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center gap-2">
                                    <button class="p-2 text-gray-400 hover:text-blue-600 transition"><i class="fas fa-edit"></i></button>
                                    <button class="p-2 text-gray-400 hover:text-red-600 transition"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex items-center justify-between">
                <p class="text-xs text-gray-500">Menampilkan 2 dari 2 anggota</p>
                <div class="flex gap-2">
                    <button class="px-3 py-1 text-xs border border-gray-300 rounded bg-white text-gray-600 disabled:opacity-50">Prev</button>
                    <button class="px-3 py-1 text-xs border border-gray-300 rounded bg-white text-gray-600">Next</button>
                </div>
            </div>
        </div>
    </main>

</body>
</html>