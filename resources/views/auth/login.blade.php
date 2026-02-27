<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Login | EduPortfolio</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        /* ── Variables ─────────────────────────────── */
        :root {
            --ink:    #0d0d0d;
            --paper:  #f7f4ef;
            --cream:  #ede9e1;
            --red:    #c8392b;
            --red-dk: #9e2d22;
            --gold:   #c9a84c;
            --muted:  #7a7672;
            --serif:  'DM Serif Display', Georgia, serif;
            --sans:   'DM Sans', system-ui, sans-serif;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: var(--sans);
            background: var(--ink);
            min-height: 100vh;
            display: flex;
            overflow: hidden;
        }

        /* ── Left Panel ─────────────────────────────── */
        .panel-left {
            width: 52%;
            min-height: 100vh;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 3rem 4rem;
            background: var(--ink);
            overflow: hidden;
        }

        /* Geometric background art */
        .panel-left::before {
            content: '';
            position: absolute;
            top: -120px; right: -120px;
            width: 500px; height: 500px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(200,57,43,.18) 0%, transparent 70%);
            pointer-events: none;
        }
        .panel-left::after {
            content: '';
            position: absolute;
            bottom: -80px; left: -80px;
            width: 380px; height: 380px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(201,168,76,.1) 0%, transparent 70%);
            pointer-events: none;
        }

        /* Grid overlay */
        .grid-overlay {
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,.025) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,.025) 1px, transparent 1px);
            background-size: 60px 60px;
            pointer-events: none;
        }

        /* Logo / Brand */
        .brand {
            position: relative;
            z-index: 2;
        }
        .brand-mark {
            display: inline-flex;
            align-items: center;
            gap: .75rem;
        }
        .brand-icon {
            width: 44px; height: 44px;
            border-radius: 10px;
            background: var(--red);
            display: flex; align-items: center; justify-content: center;
            font-size: 1.3rem;
        }
        .brand-name {
            font-family: var(--serif);
            font-size: 1.25rem;
            color: #fff;
            letter-spacing: -.01em;
        }
        .brand-name span { color: var(--gold); }

        /* Hero text */
        .hero-text {
            position: relative;
            z-index: 2;
        }
        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            font-size: .72rem;
            letter-spacing: .2em;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 1.5rem;
        }
        .eyebrow::before {
            content: '';
            display: block;
            width: 28px; height: 1px;
            background: var(--gold);
        }
        .hero-title {
            font-family: var(--serif);
            font-size: clamp(2.8rem, 4.5vw, 4rem);
            line-height: 1.1;
            color: #fff;
            margin-bottom: 1.5rem;
        }
        .hero-title em {
            font-style: italic;
            color: var(--red);
        }
        .hero-desc {
            font-size: .95rem;
            color: rgba(255,255,255,.45);
            line-height: 1.7;
            max-width: 360px;
        }

        /* Stats row */
        .stats-row {
            position: relative;
            z-index: 2;
            display: flex;
            gap: 2.5rem;
        }
        .stat {
            border-top: 1px solid rgba(255,255,255,.1);
            padding-top: 1rem;
        }
        .stat-value {
            font-family: var(--serif);
            font-size: 2rem;
            color: #fff;
            line-height: 1;
        }
        .stat-label {
            font-size: .72rem;
            letter-spacing: .1em;
            text-transform: uppercase;
            color: var(--muted);
            margin-top: .25rem;
        }

        /* Floating decorative elements */
        .deco-circle {
            position: absolute;
            border-radius: 50%;
            border: 1px solid rgba(255,255,255,.06);
        }
        .deco-circle.c1 { width: 300px; height: 300px; top: 50%; left: 50%; transform: translate(-30%, -50%); }
        .deco-circle.c2 { width: 180px; height: 180px; top: 50%; left: 50%; transform: translate(-15%, -40%); }

        /* Diagonal accent line */
        .deco-line {
            position: absolute;
            top: 0; right: 0; bottom: 0;
            width: 1px;
            background: linear-gradient(to bottom, transparent, rgba(200,57,43,.4) 40%, rgba(200,57,43,.4) 60%, transparent);
        }

        /* ── Right Panel ─────────────────────────────── */
        .panel-right {
            flex: 1;
            background: var(--paper);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 3rem 3.5rem;
            position: relative;
        }

        /* Subtle paper texture */
        .panel-right::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='4' height='4'%3E%3Crect width='4' height='4' fill='%23ede9e1'/%3E%3Ccircle cx='1' cy='1' r='.4' fill='%23d8d3c8' opacity='.4'/%3E%3C/svg%3E");
            pointer-events: none;
        }

        /* Login card */
        .login-card {
            position: relative;
            width: 100%;
            max-width: 400px;
        }

        /* Header */
        .login-header {
            margin-bottom: 2.5rem;
        }
        .login-badge {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            background: rgba(200,57,43,.08);
            border: 1px solid rgba(200,57,43,.2);
            border-radius: 30px;
            padding: .35rem .9rem;
            font-size: .72rem;
            letter-spacing: .1em;
            text-transform: uppercase;
            color: var(--red);
            margin-bottom: 1.2rem;
        }
        .login-title {
            font-family: var(--serif);
            font-size: 2.2rem;
            color: var(--ink);
            line-height: 1.15;
            margin-bottom: .6rem;
        }
        .login-subtitle {
            font-size: .88rem;
            color: var(--muted);
            line-height: 1.6;
        }

        /* Form fields */
        .field-group {
            margin-bottom: 1.25rem;
        }
        .field-label {
            display: block;
            font-size: .75rem;
            font-weight: 600;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: var(--ink);
            margin-bottom: .6rem;
        }
        .field-wrap {
            position: relative;
        }
        .field-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--muted);
            font-size: .95rem;
            pointer-events: none;
            transition: color .2s;
        }
        .field-wrap:focus-within .field-icon { color: var(--red); }

        .form-input {
            width: 100%;
            background: #fff;
            border: 1.5px solid #ddd9d1;
            border-radius: 10px;
            padding: .85rem 1rem .85rem 2.75rem;
            font-family: var(--sans);
            font-size: .92rem;
            color: var(--ink);
            outline: none;
            transition: border-color .2s, box-shadow .2s;
        }
        .form-input::placeholder { color: #b5b0a8; }
        .form-input:focus {
            border-color: var(--red);
            box-shadow: 0 0 0 3px rgba(200,57,43,.1);
        }
        .form-input.is-invalid {
            border-color: var(--red);
            background: rgba(200,57,43,.02);
        }

        /* Password toggle */
        .pwd-toggle {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: var(--muted);
            font-size: 1rem;
            padding: .25rem;
            transition: color .2s;
        }
        .pwd-toggle:hover { color: var(--red); }

        /* Error message */
        .field-error {
            font-size: .78rem;
            color: var(--red);
            margin-top: .4rem;
            display: flex;
            align-items: center;
            gap: .35rem;
        }

        /* Remember & forgot row */
        .form-meta {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.75rem;
        }
        .remember-wrap {
            display: flex;
            align-items: center;
            gap: .5rem;
            cursor: pointer;
        }
        .remember-box {
            width: 16px; height: 16px;
            border: 1.5px solid #ccc8bf;
            border-radius: 4px;
            appearance: none;
            -webkit-appearance: none;
            cursor: pointer;
            position: relative;
            transition: all .2s;
        }
        .remember-box:checked {
            background: var(--red);
            border-color: var(--red);
        }
        .remember-box:checked::after {
            content: '';
            position: absolute;
            top: 2px; left: 4px;
            width: 5px; height: 8px;
            border: 2px solid #fff;
            border-top: none;
            border-left: none;
            transform: rotate(45deg);
        }
        .remember-label {
            font-size: .82rem;
            color: var(--muted);
        }
        .forgot-link {
            font-size: .82rem;
            color: var(--red);
            text-decoration: none;
            font-weight: 500;
        }
        .forgot-link:hover { text-decoration: underline; }

        /* Submit button */
        .btn-login {
            width: 100%;
            background: var(--ink);
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 1rem;
            font-family: var(--sans);
            font-size: .9rem;
            font-weight: 600;
            letter-spacing: .04em;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transition: background .25s, transform .15s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .6rem;
        }
        .btn-login:hover {
            background: #1a1a1a;
            transform: translateY(-1px);
        }
        .btn-login:active { transform: translateY(0); }
        .btn-login::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, transparent 40%, rgba(255,255,255,.06) 100%);
        }
        .btn-login .arrow {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 22px; height: 22px;
            background: var(--red);
            border-radius: 50%;
            font-size: .75rem;
            transition: transform .25s;
        }
        .btn-login:hover .arrow { transform: translateX(3px); }

        /* Divider */
        .divider {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin: 1.5rem 0;
            color: #c5c0b8;
            font-size: .75rem;
            letter-spacing: .08em;
            text-transform: uppercase;
        }
        .divider::before, .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #ddd9d1;
        }

        /* Security badge */
        .security-note {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .5rem;
            margin-top: 2rem;
            font-size: .75rem;
            color: var(--muted);
        }
        .security-note i { color: #6ab04c; }

        /* Alert */
        .alert-error {
            background: rgba(200,57,43,.08);
            border: 1px solid rgba(200,57,43,.25);
            border-left: 3px solid var(--red);
            border-radius: 8px;
            padding: .85rem 1rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: .6rem;
            font-size: .85rem;
            color: var(--red);
        }

        /* Loading state */
        .btn-login.loading { pointer-events: none; opacity: .8; }
        .spinner {
            display: none;
            width: 16px; height: 16px;
            border: 2px solid rgba(255,255,255,.3);
            border-top-color: #fff;
            border-radius: 50%;
            animation: spin .7s linear infinite;
        }
        .btn-login.loading .spinner { display: block; }
        .btn-login.loading .btn-text,
        .btn-login.loading .arrow { display: none; }

        @keyframes spin { to { transform: rotate(360deg); } }

        /* ── Animations ─────────────────────────────── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeIn {
            from { opacity: 0; } to { opacity: 1; }
        }
        @keyframes slideRight {
            from { opacity: 0; transform: translateX(-30px); }
            to   { opacity: 1; transform: translateX(0); }
        }

        .brand    { animation: slideRight .6s ease both; }
        .eyebrow  { animation: fadeUp .6s .2s ease both; }
        .hero-title { animation: fadeUp .6s .35s ease both; }
        .hero-desc  { animation: fadeUp .6s .5s ease both; }
        .stats-row  { animation: fadeUp .6s .65s ease both; }

        .login-badge    { animation: fadeUp .5s .15s ease both; }
        .login-title    { animation: fadeUp .5s .25s ease both; }
        .login-subtitle { animation: fadeUp .5s .35s ease both; }
        .field-group:nth-child(1) { animation: fadeUp .5s .45s ease both; }
        .field-group:nth-child(2) { animation: fadeUp .5s .55s ease both; }
        .form-meta  { animation: fadeUp .5s .65s ease both; }
        .btn-login  { animation: fadeUp .5s .72s ease both; }
        .security-note { animation: fadeIn .5s 1s ease both; }

        /* ── Responsive ─────────────────────────────── */
        @media (max-width: 900px) {
            .panel-left { display: none; }
            .panel-right { padding: 2rem 1.5rem; }
        }
    </style>
</head>
<body>

<!-- ════════════ LEFT PANEL ════════════ -->
<div class="panel-left">
    <div class="grid-overlay"></div>
    <div class="deco-circle c1"></div>
    <div class="deco-circle c2"></div>
    <div class="deco-line"></div>

    <!-- Brand -->
    <div class="brand">
        <div class="brand-mark">
            <div class="brand-icon">🎓</div>
            <div class="brand-name">Edu<span>Portfolio</span></div>
        </div>
    </div>

    <!-- Hero copy -->
    <div class="hero-text">
        <div class="eyebrow">Admin Control Centre</div>
        <h1 class="hero-title">
            Manage your<br>
            <em>educational</em><br>
            empire.
        </h1>
        <p class="hero-desc">
            Full control over your portfolio — from blog posts and events to testimonials, services, and every message that comes your way.
        </p>
    </div>

    <!-- Stats -->
    <div class="stats-row">
        <div class="stat">
{{--            <div class="stat-value">9</div>--}}
{{--            <div class="stat-label">Page Types</div>--}}
        </div>
        <div class="stat">
{{--            <div class="stat-value">11</div>--}}
{{--            <div class="stat-label">DB Tables</div>--}}
        </div>
        <div class="stat">
{{--            <div class="stat-value">∞</div>--}}
{{--            <div class="stat-label">Possibilities</div>--}}
        </div>
    </div>
</div>

<!-- ════════════ RIGHT PANEL ════════════ -->
<div class="panel-right">
    <div class="login-card">

        <!-- Header -->
        <div class="login-header">
{{--            <div class="login-badge">--}}
{{--                <i class="bi bi-shield-lock-fill"></i>--}}
{{--                Secure Admin Access--}}
{{--            </div>--}}
            <h2 class="login-title">Welcome<br>back.</h2>
            <p class="login-subtitle">Sign in to manage your portfolio, content, and communications.</p>
        </div>

        <!-- Session / Auth errors -->
        @if ($errors->any())
            <div class="alert-error">
                <i class="bi bi-exclamation-circle-fill"></i>
                {{ $errors->first() }}
            </div>
        @endif

        @if (session('status'))
            <div class="alert-error" style="color:#2d7a2d;background:rgba(45,122,45,.08);border-color:rgba(45,122,45,.3);border-left-color:#2d7a2d;">
                <i class="bi bi-check-circle-fill" style="color:#2d7a2d;"></i>
                {{ session('status') }}
            </div>
        @endif

        <!-- Form -->
        <form method="POST" action="{{ route('admin.login') }}" id="loginForm">
            @csrf

            <!-- Email -->
            <div class="field-group">
                <label class="field-label" for="email">Email Address</label>
                <div class="field-wrap">
                    <i class="bi bi-envelope field-icon"></i>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-input @error('email') is-invalid @enderror"
                        value="{{ old('email') }}"
                        placeholder="uzzy.younas@gmail.com"
                        autocomplete="email"
                        autofocus
                        required
                    >
                </div>
                @error('email')
                <div class="field-error">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    {{ $message }}
                </div>
                @enderror
            </div>

            <!-- Password -->
            <div class="field-group">
                <label class="field-label" for="password">Password</label>
                <div class="field-wrap">
                    <i class="bi bi-lock field-icon"></i>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-input @error('password') is-invalid @enderror"
                        placeholder="Enter your password"
                        autocomplete="current-password"
                        required
                    >
                    <button type="button" class="pwd-toggle" id="pwdToggle" title="Show/hide password">
                        <i class="bi bi-eye-slash" id="pwdIcon"></i>
                    </button>
                </div>
                @error('password')
                <div class="field-error">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    {{ $message }}
                </div>
                @enderror
            </div>

            <!-- Remember + Forgot -->
            <div class="form-meta">
                <label class="remember-wrap">
                    <input type="checkbox" name="remember" class="remember-box" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <span class="remember-label">Keep me signed in</span>
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="forgot-link">Forgot password?</a>
                @endif
            </div>

            <!-- Submit -->
            <button type="submit" class="btn-login" id="loginBtn">
                <span class="spinner"></span>
                <span class="btn-text">Sign In to Dashboard</span>
                <span class="arrow"><i class="bi bi-arrow-right"></i></span>
            </button>
        </form>

        <!-- Security note -->
        <div class="security-note">
{{--            <i class="bi bi-shield-check-fill"></i>--}}
{{--            Protected by CSRF & session encryption--}}
        </div>
    </div>
</div>

<script>
    // Password visibility toggle
    const pwdInput  = document.getElementById('password');
    const pwdToggle = document.getElementById('pwdToggle');
    const pwdIcon   = document.getElementById('pwdIcon');

    pwdToggle.addEventListener('click', () => {
        const isHidden = pwdInput.type === 'password';
        pwdInput.type = isHidden ? 'text' : 'password';
        pwdIcon.className = isHidden ? 'bi bi-eye' : 'bi bi-eye-slash';
    });

    // Loading state on submit
    document.getElementById('loginForm').addEventListener('submit', function() {
        const btn = document.getElementById('loginBtn');
        btn.classList.add('loading');

        // Reset after 6s as failsafe
        setTimeout(() => btn.classList.remove('loading'), 6000);
    });

    // Shake animation on error
    @if($errors->any())
    const card = document.querySelector('.login-card');
    card.style.animation = 'shake .4s ease';
    @endif
</script>

<style>
    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        20%       { transform: translateX(-8px); }
        40%       { transform: translateX(8px); }
        60%       { transform: translateX(-5px); }
        80%       { transform: translateX(5px); }
    }
</style>

</body>
</html>
