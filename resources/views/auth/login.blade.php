<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Admin Portfolio</title>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'DM Sans', sans-serif; background: #0a0a0f; min-height: 100vh; display: flex; align-items: center; justify-content: center; position: relative; overflow: hidden; }
        .bg-orb { position: absolute; border-radius: 50%; filter: blur(80px); pointer-events: none; }
        .orb-1 { width: 400px; height: 400px; background: rgba(108,99,255,0.12); top: -100px; right: -100px; }
        .orb-2 { width: 300px; height: 300px; background: rgba(255,107,107,0.08); bottom: -80px; left: -80px; }
        .login-card { position: relative; background: #16161f; border: 1px solid rgba(255,255,255,0.08); border-radius: 20px; padding: 48px 40px; width: 100%; max-width: 400px; z-index: 1; }
        .login-card::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px; background: linear-gradient(90deg, #6c63ff, #ff6b6b, #00d4aa); border-radius: 20px 20px 0 0; }
        .login-logo { text-align: center; margin-bottom: 32px; }
        .login-logo .icon { width: 52px; height: 52px; background: linear-gradient(135deg, #6c63ff, #5048c9); border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 22px; margin: 0 auto 16px; box-shadow: 0 8px 24px rgba(108,99,255,0.4); }
        .login-logo h1 { font-family: 'Syne', sans-serif; font-size: 22px; font-weight: 800; color: #fff; margin-bottom: 4px; }
        .login-logo p { color: #7a7a9a; font-size: 14px; }
        .form-group { display: flex; flex-direction: column; gap: 8px; margin-bottom: 18px; }
        label { font-size: 13px; font-weight: 600; color: #7a7a9a; }
        input[type="email"], input[type="password"] { background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); border-radius: 10px; padding: 12px 16px; color: #e8e8f0; font-family: 'DM Sans', sans-serif; font-size: 15px; transition: all 0.2s; width: 100%; }
        input:focus { outline: none; border-color: #6c63ff; background: rgba(108,99,255,0.06); }
        input::placeholder { color: rgba(255,255,255,0.2); }
        .remember-row { display: flex; align-items: center; gap: 8px; margin-bottom: 24px; }
        .remember-row input { width: auto; accent-color: #6c63ff; }
        .remember-row label { color: #7a7a9a; font-size: 14px; margin: 0; }
        .btn-login { width: 100%; padding: 13px; background: linear-gradient(135deg, #6c63ff, #5048c9); border: none; border-radius: 10px; color: #fff; font-family: 'DM Sans', sans-serif; font-size: 15px; font-weight: 600; cursor: pointer; transition: all 0.2s; box-shadow: 0 4px 20px rgba(108,99,255,0.4); }
        .btn-login:hover { transform: translateY(-2px); }
        .error-msg { background: rgba(255,107,107,0.1); border: 1px solid rgba(255,107,107,0.25); color: #ff6b6b; padding: 12px 16px; border-radius: 8px; font-size: 14px; margin-bottom: 20px; }
        .back-link { display: block; text-align: center; margin-top: 20px; font-size: 14px; color: #7a7a9a; }
        .back-link:hover { color: #e8e8f0; }
    </style>
</head>
<body>
    <div class="bg-orb orb-1"></div>
    <div class="bg-orb orb-2"></div>
    <div class="login-card">
        <div class="login-logo">
            <div class="icon">⚡</div>
            <h1>Admin Panel</h1>
            <p>Masuk untuk mengelola portfolio</p>
        </div>
        @if($errors->any())
        <div class="error-msg">{{ $errors->first() }}</div>
        @endif
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="admin@portfolio.com" required autofocus>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="••••••••" required>
            </div>
            <div class="remember-row">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Ingat saya</label>
            </div>
            <button type="submit" class="btn-login">Masuk →</button>
        </form>
        <a href="{{ route('home') }}" class="back-link">← Kembali ke Portfolio</a>
    </div>
</body>
</html>
