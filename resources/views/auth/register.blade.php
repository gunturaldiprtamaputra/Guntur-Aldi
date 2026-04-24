<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register — Sistem Peminjaman Alat</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root { --primary: #1a56db; --primary-dark: #1e429f; --accent: #06b6d4; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; min-height: 100vh; display: flex; align-items: center; justify-content: center; overflow: hidden; background: #0f172a; }
        .bg-scene { position: fixed; inset: 0; z-index: 0; background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 40%, #0c4a6e 70%, #0f172a 100%); }
        .bg-scene::before { content: ''; position: absolute; inset: 0; background: radial-gradient(ellipse 80% 60% at 20% 30%, rgba(6,182,212,0.25) 0%, transparent 60%), radial-gradient(ellipse 60% 50% at 80% 70%, rgba(26,86,219,0.30) 0%, transparent 60%); animation: pulse-bg 8s ease-in-out infinite alternate; }
        @keyframes pulse-bg { 0% { opacity: 0.7; transform: scale(1); } 100% { opacity: 1; transform: scale(1.05); } }
        .orb { position: fixed; border-radius: 50%; filter: blur(70px); pointer-events: none; animation: float 12s ease-in-out infinite; }
        .orb-1 { width: 400px; height: 400px; background: rgba(6,182,212,0.20); top: -100px; left: -100px; }
        .orb-2 { width: 300px; height: 300px; background: rgba(26,86,219,0.25); bottom: -80px; right: -80px; animation-delay: -4s; }
        .orb-3 { width: 200px; height: 200px; background: rgba(124,58,237,0.20); top: 50%; right: 10%; animation-delay: -8s; }
        @keyframes float { 0%, 100% { transform: translate(0,0) scale(1); } 33% { transform: translate(30px,-30px) scale(1.05); } 66% { transform: translate(-20px,20px) scale(0.95); } }
        .grid-overlay { position: fixed; inset: 0; pointer-events: none; background-image: linear-gradient(rgba(255,255,255,0.03) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.03) 1px, transparent 1px); background-size: 50px 50px; }
        .register-wrapper { position: relative; z-index: 10; width: 100%; max-width: 480px; padding: 20px; animation: slide-up 0.7s cubic-bezier(0.16,1,0.3,1) both; }
        @keyframes slide-up { from { opacity: 0; transform: translateY(40px); } to { opacity: 1; transform: translateY(0); } }
        .register-card { background: rgba(15,23,42,0.70); backdrop-filter: blur(24px); -webkit-backdrop-filter: blur(24px); border: 1px solid rgba(255,255,255,0.12); border-radius: 24px; padding: 40px 40px; box-shadow: 0 25px 60px rgba(0,0,0,0.5), 0 0 0 1px rgba(255,255,255,0.05) inset, 0 1px 0 rgba(255,255,255,0.15) inset; }
        .brand-icon { width: 56px; height: 56px; background: linear-gradient(135deg, #1a56db, #06b6d4); border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 24px; margin: 0 auto 16px; box-shadow: 0 8px 24px rgba(26,86,219,0.5); }
        .brand-title { font-size: 24px; font-weight: 800; color: #fff; text-align: center; letter-spacing: -0.5px; margin-bottom: 4px; }
        .brand-subtitle { text-align: center; color: rgba(255,255,255,0.5); font-size: 13px; margin-bottom: 28px; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
        .form-group { margin-bottom: 16px; }
        .form-label { display: block; font-size: 13px; font-weight: 600; color: rgba(255,255,255,0.7); margin-bottom: 7px; }
        .input-wrap { position: relative; }
        .input-icon { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: rgba(255,255,255,0.35); font-size: 14px; pointer-events: none; }
        .form-control { width: 100%; padding: 11px 14px 11px 40px; background: rgba(255,255,255,0.07); border: 1px solid rgba(255,255,255,0.12); border-radius: 12px; color: #fff; font-family: inherit; font-size: 14px; transition: all 0.2s; outline: none; }
        .form-control::placeholder { color: rgba(255,255,255,0.25); }
        .form-control:focus { border-color: rgba(26,86,219,0.7); background: rgba(26,86,219,0.12); box-shadow: 0 0 0 3px rgba(26,86,219,0.20); }
        select.form-control { appearance: none; -webkit-appearance: none; cursor: pointer; }
        .select-arrow { position: absolute; right: 14px; top: 50%; transform: translateY(-50%); color: rgba(255,255,255,0.35); font-size: 12px; pointer-events: none; }
        .toggle-pw { position: absolute; right: 14px; top: 50%; transform: translateY(-50%); background: none; border: none; color: rgba(255,255,255,0.35); cursor: pointer; font-size: 14px; transition: color 0.2s; padding: 0; }
        .toggle-pw:hover { color: rgba(255,255,255,0.7); }
        .btn-register { width: 100%; padding: 13px; background: linear-gradient(135deg, #1a56db 0%, #1e429f 60%, #1a56db 100%); background-size: 200% 100%; border: none; border-radius: 12px; color: #fff; font-family: inherit; font-size: 15px; font-weight: 700; cursor: pointer; letter-spacing: 0.5px; transition: all 0.3s; box-shadow: 0 6px 20px rgba(26,86,219,0.5); display: flex; align-items: center; justify-content: center; gap: 8px; margin-top: 4px; }
        .btn-register:hover { background-position: right center; box-shadow: 0 8px 28px rgba(26,86,219,0.65); transform: translateY(-1px); }
        .btn-register:active { transform: translateY(0); }
        .footer-link { text-align: center; margin-top: 20px; font-size: 13px; color: rgba(255,255,255,0.45); }
        .footer-link a { color: #60a5fa; font-weight: 600; text-decoration: none; transition: color 0.2s; }
        .footer-link a:hover { color: #93c5fd; text-decoration: underline; }
        .divider { display: flex; align-items: center; gap: 10px; margin: 6px 0 16px; }
        .divider::before, .divider::after { content: ''; flex: 1; height: 1px; background: rgba(255,255,255,0.10); }
        .divider span { color: rgba(255,255,255,0.30); font-size: 11px; }
        .role-pills { display: flex; gap: 8px; margin-bottom: 4px; }
        .role-pill { flex: 1; padding: 8px 10px; border: 1px solid rgba(255,255,255,0.12); border-radius: 10px; background: transparent; color: rgba(255,255,255,0.45); font-family: inherit; font-size: 13px; font-weight: 600; cursor: pointer; transition: all 0.2s; display: flex; align-items: center; justify-content: center; gap: 6px; }
        .role-pill.active { background: rgba(26,86,219,0.25); border-color: rgba(26,86,219,0.6); color: #93c5fd; }
        .role-pill:hover:not(.active) { border-color: rgba(255,255,255,0.25); color: rgba(255,255,255,0.7); }
        .strength-bar { display: flex; gap: 4px; margin-top: 8px; }
        .strength-seg { flex: 1; height: 3px; border-radius: 2px; background: rgba(255,255,255,0.1); transition: background 0.3s; }
        .strength-seg.weak { background: #ef4444; }
        .strength-seg.medium { background: #f59e0b; }
        .strength-seg.strong { background: #22c55e; }
    </style>
</head>
<body>
    <div class="bg-scene"></div>
    <div class="grid-overlay"></div>
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>

    <div class="register-wrapper">
        <div class="register-card">
            <div class="brand-icon">🔧</div>
            <div class="brand-title">Buat Akun</div>
            <div class="brand-subtitle">Sistem Manajemen Peminjaman Alat</div>

            <div class="form-group" style="margin-bottom:20px;">
                <div class="form-label" style="margin-bottom:10px;">Daftar Sebagai</div>
                <div class="role-pills">
                    <button type="button" class="role-pill active" onclick="setRole('siswa',this)" id="pill-siswa">
                        <i class="fa-solid fa-graduation-cap" style="font-size:13px;"></i> Siswa
                    </button>
                    <button type="button" class="role-pill" onclick="setRole('guru',this)" id="pill-guru">
                        <i class="fa-solid fa-chalkboard-user" style="font-size:13px;"></i> Guru
                    </button>
                </div>
                <input type="hidden" name="role" id="roleInput" value="user">
            </div>

            <form method="POST" action="{{ url('/register') }}">
                @csrf

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Nama Lengkap</label>
                        <div class="input-wrap">
                            <i class="fa-solid fa-user input-icon"></i>
                            <input type="text" name="name" class="form-control"
                                   placeholder="Nama kamu" required autofocus>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <div class="input-wrap">
                            <i class="fa-solid fa-envelope input-icon"></i>
                            <input type="email" name="email" class="form-control"
                                   placeholder="email@contoh.com" required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Password</label>
                    <div class="input-wrap">
                        <i class="fa-solid fa-lock input-icon"></i>
                        <input type="password" name="password" id="pwField" class="form-control"
                               placeholder="Min. 8 karakter" required oninput="checkStrength(this.value)">
                        <button type="button" class="toggle-pw" onclick="togglePw('pwField','eye1')">
                            <i class="fa-solid fa-eye" id="eye1"></i>
                        </button>
                    </div>
                    <div class="strength-bar">
                        <div class="strength-seg" id="s1"></div>
                        <div class="strength-seg" id="s2"></div>
                        <div class="strength-seg" id="s3"></div>
                        <div class="strength-seg" id="s4"></div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Konfirmasi Password</label>
                    <div class="input-wrap">
                        <i class="fa-solid fa-shield-halved input-icon"></i>
                        <input type="password" name="password_confirmation" id="pwField2" class="form-control"
                               placeholder="Ulangi password" required>
                        <button type="button" class="toggle-pw" onclick="togglePw('pwField2','eye2')">
                            <i class="fa-solid fa-eye" id="eye2"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn-register">
                    <i class="fa-solid fa-user-plus"></i> Daftar Sekarang
                </button>
            </form>

            <div class="divider" style="margin-top:20px;"><span>atau</span></div>
            <div class="footer-link">
                Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
            </div>
        </div>
    </div>

    <script>
        function togglePw(fieldId, eyeId) {
            var f = document.getElementById(fieldId);
            var e = document.getElementById(eyeId);
            if (f.type === 'password') {
                f.type = 'text';
                e.className = 'fa-solid fa-eye-slash';
            } else {
                f.type = 'password';
                e.className = 'fa-solid fa-eye';
            }
        }

        function setRole(role, el) {
            document.querySelectorAll('.role-pill').forEach(function(p) { p.classList.remove('active'); });
            el.classList.add('active');
            document.getElementById('roleInput').value = 'user';
        }

        function checkStrength(val) {
            var segs = [document.getElementById('s1'), document.getElementById('s2'),
                        document.getElementById('s3'), document.getElementById('s4')];
            segs.forEach(function(s) { s.className = 'strength-seg'; });
            var score = 0;
            if (val.length >= 8) score++;
            if (/[A-Z]/.test(val)) score++;
            if (/[0-9]/.test(val)) score++;
            if (/[^A-Za-z0-9]/.test(val)) score++;
            var cls = score <= 1 ? 'weak' : score <= 2 ? 'medium' : 'strong';
            for (var i = 0; i < score; i++) segs[i].classList.add(cls);
        }
    </script>
</body>
</html>