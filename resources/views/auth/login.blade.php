<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Sistem Peminjaman Alat</title>
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
        .login-wrapper { position: relative; z-index: 10; width: 100%; max-width: 460px; padding: 20px; animation: slide-up 0.7s cubic-bezier(0.16,1,0.3,1) both; }
        @keyframes slide-up { from { opacity: 0; transform: translateY(40px); } to { opacity: 1; transform: translateY(0); } }
        .login-card { background: rgba(15,23,42,0.70); backdrop-filter: blur(24px); -webkit-backdrop-filter: blur(24px); border: 1px solid rgba(255,255,255,0.12); border-radius: 24px; padding: 44px 40px; box-shadow: 0 25px 60px rgba(0,0,0,0.5), 0 0 0 1px rgba(255,255,255,0.05) inset, 0 1px 0 rgba(255,255,255,0.15) inset; }
        .brand-icon { width: 64px; height: 64px; background: linear-gradient(135deg, #1a56db, #06b6d4); border-radius: 18px; display: flex; align-items: center; justify-content: center; font-size: 28px; margin: 0 auto 20px; box-shadow: 0 8px 24px rgba(26,86,219,0.5); }
        .brand-title { font-size: 26px; font-weight: 800; color: #fff; text-align: center; letter-spacing: -0.5px; margin-bottom: 6px; }
        .brand-subtitle { text-align: center; color: rgba(255,255,255,0.5); font-size: 13.5px; margin-bottom: 32px; }
        .role-tabs { display: flex; gap: 8px; margin-bottom: 28px; background: rgba(255,255,255,0.05); border-radius: 12px; padding: 4px; }
        .role-tab { flex: 1; padding: 9px; border: none; border-radius: 9px; font-family: inherit; font-size: 13px; font-weight: 600; cursor: pointer; transition: all 0.25s; color: rgba(255,255,255,0.5); background: transparent; display: flex; align-items: center; justify-content: center; gap: 6px; }
        .role-tab.active { background: linear-gradient(135deg, #1a56db, #1e429f); color: #fff; box-shadow: 0 4px 12px rgba(26,86,219,0.4); }
        .role-tab:hover:not(.active) { color: rgba(255,255,255,0.8); background: rgba(255,255,255,0.08); }
        .form-group { margin-bottom: 18px; }
        .form-label { display: block; font-size: 13px; font-weight: 600; color: rgba(255,255,255,0.7); margin-bottom: 8px; }
        .input-wrap { position: relative; }
        .input-icon { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: rgba(255,255,255,0.35); font-size: 15px; pointer-events: none; }
        .form-control { width: 100%; padding: 12px 14px 12px 42px; background: rgba(255,255,255,0.07); border: 1px solid rgba(255,255,255,0.12); border-radius: 12px; color: #fff; font-family: inherit; font-size: 14.5px; transition: all 0.2s; outline: none; }
        .form-control::placeholder { color: rgba(255,255,255,0.25); }
        .form-control:focus { border-color: rgba(26,86,219,0.7); background: rgba(26,86,219,0.12); box-shadow: 0 0 0 3px rgba(26,86,219,0.20); }
        .toggle-pw { position: absolute; right: 14px; top: 50%; transform: translateY(-50%); background: none; border: none; color: rgba(255,255,255,0.35); cursor: pointer; font-size: 15px; transition: color 0.2s; }
        .toggle-pw:hover { color: rgba(255,255,255,0.7); }
        .remember-row { display: flex; align-items: center; gap: 10px; margin-bottom: 24px; }
        .remember-row input[type="checkbox"] { width: 16px; height: 16px; accent-color: #1a56db; cursor: pointer; }
        .remember-row label { font-size: 13px; color: rgba(255,255,255,0.55); cursor: pointer; }
        .btn-login { width: 100%; padding: 14px; background: linear-gradient(135deg, #1a56db 0%, #1e429f 60%, #1a56db 100%); background-size: 200% 100%; border: none; border-radius: 12px; color: #fff; font-family: inherit; font-size: 15px; font-weight: 700; cursor: pointer; letter-spacing: 0.5px; transition: all 0.3s; box-shadow: 0 6px 20px rgba(26,86,219,0.5); display: flex; align-items: center; justify-content: center; gap: 8px; }
        .btn-login:hover { background-position: right center; box-shadow: 0 8px 28px rgba(26,86,219,0.65); transform: translateY(-1px); }
        .btn-login:active { transform: translateY(0); }
        .alert-danger { background: rgba(239,68,68,0.15); border: 1px solid rgba(239,68,68,0.35); border-radius: 10px; padding: 12px 16px; color: #fca5a5; font-size: 13px; margin-bottom: 20px; }
        .footer-link { text-align: center; margin-top: 24px; font-size: 13.5px; color: rgba(255,255,255,0.45); }
        .footer-link a { color: #60a5fa; font-weight: 600; text-decoration: none; transition: color 0.2s; }
        .footer-link a:hover { color: #93c5fd; text-decoration: underline; }
        .divider { display: flex; align-items: center; gap: 12px; margin: 20px 0; }
        .divider::before, .divider::after { content: ''; flex: 1; height: 1px; background: rgba(255,255,255,0.10); }
        .divider span { color: rgba(255,255,255,0.30); font-size: 12px; }
        .info-badge { display: inline-flex; align-items: center; gap: 6px; background: rgba(6,182,212,0.12); border: 1px solid rgba(6,182,212,0.25); border-radius: 8px; padding: 7px 12px; font-size: 12px; color: rgba(6,182,212,0.9); margin-top: 16px; width: 100%; justify-content: center; }
    </style>
</head>
<body>
    <div class="bg-scene"></div>
    <div class="grid-overlay"></div>
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>

    <div class="login-wrapper">
        <div class="login-card">
            <div class="brand-icon">🔧</div>
            <div class="brand-title">SiPinjamAlat</div>
            <div class="brand-subtitle">Sistem Manajemen Peminjaman Alat</div>

            <div class="role-tabs">
                <button class="role-tab active" onclick="setRole('user', this)">
                    <i class="fa-solid fa-user"></i> User
                </button>
                <button class="role-tab" onclick="setRole('admin', this)">
                    <i class="fa-solid fa-shield-halved"></i> Admin
                </button>
            </div>

            @if($errors->any())
                <div class="alert-danger">
                    @foreach($errors->all() as $e)<div>⚠ {{ $e }}</div>@endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <div class="input-wrap">
                        <i class="fa-solid fa-envelope input-icon"></i>
                        <input type="email" name="email" class="form-control"
                               value="{{ old('email') }}"
                               placeholder="email@example.com" required autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Password</label>
                    <div class="input-wrap">
                        <i class="fa-solid fa-lock input-icon"></i>
                        <input type="password" name="password" id="pwField"
                               class="form-control" placeholder="Masukkan password" required>
                        <button type="button" class="toggle-pw" onclick="togglePw()">
                            <i class="fa-solid fa-eye" id="eyeIcon"></i>
                        </button>
                    </div>
                </div>
                <div class="remember-row">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember">Ingat saya di perangkat ini</label>
                </div>
                <button type="submit" class="btn-login">
                    <i class="fa-solid fa-right-to-bracket"></i> Masuk Sekarang
                </button>
            </form>

            <div class="divider"><span>atau</span></div>
            <div class="footer-link">
                Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>
            </div>
            <div class="info-badge">
                <i class="fa-solid fa-circle-info"></i>
                Login sebagai Admin → diarahkan ke dashboard admin
            </div>
        </div>
    </div>

    <script>
        function togglePw() {
            var f = document.getElementById('pwField');
            var e = document.getElementById('eyeIcon');
            if (f.type === 'password') {
                f.type = 'text';
                e.className = 'fa-solid fa-eye-slash';
            } else {
                f.type = 'password';
                e.className = 'fa-solid fa-eye';
            }
        }
        function setRole(role, el) {
            document.querySelectorAll('.role-tab').forEach(function(t) {
                t.classList.remove('active');
            });
            el.classList.add('active');
        }
    </script>
</body>
</html>