<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel') | Portfolio Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root { --sidebar-width: 260px; --topbar-height: 60px; }
        body { font-family: 'Inter', sans-serif; background: #f0f2f5; }
        .sidebar { width: var(--sidebar-width); height: 100vh; position: fixed; top: 0; left: 0; background: linear-gradient(180deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%); overflow-y: auto; z-index: 1000; transition: transform .3s; }
        .sidebar-brand { padding: 1.2rem 1.5rem; border-bottom: 1px solid rgba(255,255,255,.1); }
        .sidebar-brand h6 { color: #fff; font-weight: 700; margin: 0; font-size: 1rem; }
        .sidebar-brand small { color: rgba(255,255,255,.5); font-size: .65rem; letter-spacing: 1px; }
        .sidebar-menu { padding: 1rem 0; }
        .sidebar-menu .menu-label { padding: .4rem 1.5rem; font-size: .65rem; text-transform: uppercase; letter-spacing: 1.5px; color: rgba(255,255,255,.4); margin-top: .5rem; }
        .sidebar-menu a { display: flex; align-items: center; padding: .6rem 1.5rem; color: rgba(255,255,255,.7); text-decoration: none; font-size: .875rem; border-left: 3px solid transparent; transition: all .2s; }
        .sidebar-menu a:hover, .sidebar-menu a.active { color: #fff; background: rgba(255,255,255,.08); border-left-color: #e94560; }
        .sidebar-menu a i { width: 20px; margin-right: .75rem; font-size: 1rem; }
        .topbar { height: var(--topbar-height); background: #fff; border-bottom: 1px solid #e9ecef; position: fixed; top: 0; left: var(--sidebar-width); right: 0; z-index: 999; display: flex; align-items: center; padding: 0 1.5rem; }
        .main-content { margin-left: var(--sidebar-width); margin-top: var(--topbar-height); padding: 1.5rem; min-height: calc(100vh - var(--topbar-height)); }
        .stat-card { background: #fff; border-radius: 12px; padding: 1.5rem; border: 1px solid #e9ecef; transition: transform .2s, box-shadow .2s; }
        .stat-card:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(0,0,0,.1); }
        .stat-icon { width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; }
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.show { transform: translateX(0); }
            .topbar, .main-content { left: 0; margin-left: 0; }
        }
    </style>
    @stack('styles')
</head>
<body>

<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <h6><i class="bi bi-mortarboard-fill me-2 text-warning"></i>EduPortfolio</h6>
        <small>ADMIN PANEL</small>
    </div>
    <div class="sidebar-menu">
        <div class="menu-label">Overview</div>
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>

        <div class="menu-label">Content</div>
        <a href="{{ route('admin.posts.index') }}" class="{{ request()->routeIs('admin.posts.*') ? 'active' : '' }}">
            <i class="bi bi-file-earmark-richtext"></i> Blog Posts
        </a>
        <a href="{{ route('admin.categories.index') }}" class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
            <i class="bi bi-tags"></i> Categories
        </a>
        <a href="{{ route('admin.services.index') }}" class="{{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
            <i class="bi bi-grid"></i> Services
        </a>
        <a href="{{ route('admin.events.index') }}" class="{{ request()->routeIs('admin.events.*') ? 'active' : '' }}">
            <i class="bi bi-calendar-event"></i> Events
        </a>

        <div class="menu-label">Media & Social</div>
        <a href="{{ route('admin.gallery.index') }}" class="{{ request()->routeIs('admin.gallery.*') ? 'active' : '' }}">
            <i class="bi bi-images"></i> Gallery
        </a>
        <a href="{{ route('admin.testimonials.index') }}" class="{{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}">
            <i class="bi bi-chat-square-quote"></i> Testimonials
        </a>
        <a href="{{ route('admin.certificates.index') }}" class="{{ request()->routeIs('admin.certificates.*') ? 'active' : '' }}">
            <i class="bi bi-award"></i> Certificates
        </a>

        <div class="menu-label">Communication</div>
        <a href="{{ route('admin.messages.index') }}" class="{{ request()->routeIs('admin.messages.*') ? 'active' : '' }}">
            <i class="bi bi-envelope"></i> Messages
            @php $unread = \App\Models\ContactMessage::where('is_read',false)->count(); @endphp
            @if($unread > 0)<span class="badge bg-danger ms-auto">{{ $unread }}</span>@endif
        </a>
        <a href="{{ route('admin.newsletter.index') }}" class="{{ request()->routeIs('admin.newsletter.*') ? 'active' : '' }}">
            <i class="bi bi-megaphone"></i> Newsletter
        </a>

        <div class="menu-label">Account</div>
        <a href="{{ route('home') }}" target="_blank">
            <i class="bi bi-globe"></i> View Site
        </a>
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" style="background:none;border:none;width:100%;text-align:left;"
                    class="d-flex align-items-center">
                <a class="w-100" style="color:inherit;pointer-events:none;">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
            </button>
        </form>
    </div>
</div>

<!-- Topbar -->
<div class="topbar">
    <button class="btn btn-sm btn-light d-lg-none me-2" onclick="document.getElementById('sidebar').classList.toggle('show')">
        <i class="bi bi-list fs-5"></i>
    </button>
    <nav aria-label="breadcrumb" class="flex-grow-1">
        <ol class="breadcrumb mb-0 small">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
            @yield('breadcrumb')
        </ol>
    </nav>
    <div class="d-flex align-items-center gap-3">
        <span class="text-muted small">{{ auth()->user()->name ?? 'Admin' }}</span>
        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'Admin') }}&background=e94560&color=fff&size=36" class="rounded-circle" width="36" height="36">
    </div>
</div>

<!-- Main Content -->
<div class="main-content">

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
