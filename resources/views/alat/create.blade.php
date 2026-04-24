<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Alat - SMK Kiansantang</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background: radial-gradient(circle at top left, #f8fafc, #ffffff); min-height: 100vh; display: flex; align-items: center; justify-content: center; font-family: sans-serif; }
        .glass-card { background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px); border: 1px solid #e2e8f0; border-radius: 2rem; padding: 2.5rem; width: 100%; max-width: 450px; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1); }
    </style>
</head>
<body>

    <div class="glass-card">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-slate-800">Tambah <span class="text-indigo-600">Alat Baru</span></h1>
            <p class="text-slate-500 text-sm mt-1">Lengkapi detail informasi alat di bawah ini.</p>
        </div>

        <form action="{{ route('alat.store') }}" method="POST" class="space-y-6">
            @csrf <div>
                <label class="block text-xs font-bold text-indigo-500 uppercase tracking-widest mb-2 ml-1">Nama Alat</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400">
                        <i class="fas fa-wrench"></i>
                    </span>
                    <input type="text" name="nama_alat" required placeholder="Contoh: Solder Listrik" 
                        class="w-full pl-10 pr-4 py-3 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 outline-none transition-all">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-indigo-500 uppercase tracking-widest mb-2 ml-1">Kategori</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400">
                        <i class="fas fa-tag"></i>
                    </span>
                    <select name="kategori" required class="w-full pl-10 pr-4 py-3 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 outline-none appearance-none bg-white">
                        <option value="" disabled selected>Pilih Kategori</option>
                        <option value="Elektronik">Elektronik</option>
                        <option value="Mekanik">Mekanik</option>
                        <option value="Perkakas">Perkakas</option>
                    </select>
                </div>
            </div>

            <div class="flex flex-col gap-3 pt-4">
                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 rounded-xl shadow-lg transition-all active:scale-95">
                    Simpan Alat
                </button>
                <a href="{{ route('alat.index') }}" class="w-full text-center text-slate-500 font-semibold py-2 hover:bg-slate-100 rounded-xl transition-all">
                    Batal
                </a>
            </div>
        </form>
    </div>

</body>
</html>