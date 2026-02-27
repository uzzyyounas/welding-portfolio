<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- SEO Meta -->
    <title>@yield('title', config('app.name', 'Dr. Sarah Ahmed') . ' | Educationist & Motivational Speaker')</title>
    <meta name="description" content="@yield('meta_description', 'Certified Teacher Trainer, Motivational Speaker & Digital Learning Specialist. Empowering educators and inspiring minds across South Asia.')">
    <meta name="keywords" content="@yield('meta_keywords', 'teacher trainer, motivational speaker, digital learning, education consultant, Pakistan')">

    <!-- Open Graph -->
    <meta property="og:title" content="@yield('title', 'Dr. Sarah Ahmed')">
    <meta property="og:description" content="@yield('meta_description', 'Empowering Educators. Inspiring Minds.')">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="@yield('og_image', asset('images/og-default.jpg'))">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <!-- GLightbox -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css">
    <!-- Animate on Scroll -->
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @stack('styles')
</head>
<body>

    <!-- Top Bar -->
    <div class="topbar bg-primary py-1">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <small class="text-white">
                        <i class="bi bi-envelope me-1"></i> awaisiqbalch@email.com
                        <span class="mx-2">|</span>
                        <i class="bi bi-telephone me-1"></i> +92 333 5071204
                    </small>
                </div>
                <div class="col-md-4 text-end">
                    <a href="https://facebook.com" class="text-white me-2"><i class="bi bi-facebook"></i></a>
                    <a href="https://twitter.com" class="text-white me-2"><i class="bi bi-twitter-x"></i></a>
                    <a href="https://linkedin.com" class="text-white me-2"><i class="bi bi-linkedin"></i></a>
                    <a href="https://youtube.com" class="text-white me-2"><i class="bi bi-youtube"></i></a>
                    <a href="https://instagram.com" class="text-white"><i class="bi bi-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <span class="brand-name"><strong>Awais Iqbal Ch</strong></span>
                <small class="d-block brand-tagline text-muted" style="font-size:0.65rem;letter-spacing:1px;">EDUCATIONIST & MOTIVATIONAL SPEAKER</small>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('services.*') ? 'active' : '' }}" href="{{ route('services.index') }}">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('workshops.*') ? 'active' : '' }}" href="{{ route('workshops.index') }}">Workshops</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('blog.*') ? 'active' : '' }}" href="{{ route('blog.index') }}">Blog</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">More</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('gallery.index') }}"><i class="bi bi-images me-2"></i>Gallery</a></li>
                            <li><a class="dropdown-item" href="{{ route('testimonials.index') }}"><i class="bi bi-chat-quote me-2"></i>Testimonials</a></li>
                            <li><a class="dropdown-item" href="{{ route('certifications.index') }}"><i class="bi bi-award me-2"></i>Certifications</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary px-4 ms-2" href="{{ route('contact.index') }}">Contact Me</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show m-0 rounded-0" role="alert">
            <div class="container"><i class="bi bi-check-circle me-2"></i>{{ session('success') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show m-0 rounded-0" role="alert">
            <div class="container"><i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Main Content -->
    <main>@yield('content')</main>

    <!-- Newsletter Section -->
    <section class="newsletter-section bg-primary text-white py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-3 mb-lg-0">
                    <h4 class="mb-1">Stay Inspired & Informed</h4>
                    <p class="mb-0 opacity-75">Subscribe to my newsletter for teaching tips, event updates & motivational insights.</p>
                </div>
                <div class="col-lg-6">
                    <form action="{{ route('newsletter.subscribe') }}" method="POST" class="d-flex gap-2">
                        @csrf
                        <input type="email" name="email" class="form-control" placeholder="Your email address" required>
                        <button type="submit" class="btn btn-light text-primary fw-semibold px-4 text-nowrap">Subscribe</button>
                    </form>
                    @if(session('newsletter_success'))
                        <small class="text-warning mt-1 d-block">{{ session('newsletter_success') }}</small>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-light pt-5 pb-3">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <h5 class="text-white mb-3">Awais Iqbal Ch</h5>
                    <p class="text-white small">Empowering educators and inspiring minds through innovative teaching methodologies and transformative learning experiences.</p>
                    <div class="social-links mt-3">
                        <a href="#" class="btn btn-sm btn-outline-secondary me-1"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="btn btn-sm btn-outline-secondary me-1"><i class="bi bi-twitter-x"></i></a>
                        <a href="#" class="btn btn-sm btn-outline-secondary me-1"><i class="bi bi-linkedin"></i></a>
                        <a href="#" class="btn btn-sm btn-outline-secondary me-1"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>
                <div class="col-lg-2">
                    <h6 class="text-white mb-3">Quick Links</h6>
                    <ul class="list-unstyled small">
                        <li><a href="{{ route('home') }}" class="text-white text-decoration-none hover-text-white">Home</a></li>
                        <li><a href="{{ route('about') }}" class="text-white text-decoration-none">About</a></li>
                        <li><a href="{{ route('services.index') }}" class="text-white text-decoration-none">Services</a></li>
                        <li><a href="{{ route('workshops.index') }}" class="text-white text-decoration-none">Workshops</a></li>
                        <li><a href="{{ route('blog.index') }}" class="text-white text-decoration-none">Blog</a></li>
                    </ul>
                </div>
                <div class="col-lg-2">
                    <h6 class="text-white mb-3">Resources</h6>
                    <ul class="list-unstyled small">
                        <li><a href="{{ route('gallery.index') }}" class="text-white text-decoration-none">Gallery</a></li>
                        <li><a href="{{ route('testimonials.index') }}" class="text-white text-decoration-none">Testimonials</a></li>
                        <li><a href="{{ route('certifications.index') }}" class="text-white text-decoration-none">Certifications</a></li>
                        <li><a href="{{ route('contact.index') }}" class="text-white text-decoration-none">Contact</a></li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h6 class="text-white mb-3">Contact Info</h6>
                    <ul class="list-unstyled small text-muted">
                        <li class="mb-2 text-white"><i class="bi bi-geo-alt me-2 text-primary"></i>Dahranwala, Pakistan</li>
                        <li class="mb-2 text-white"><i class="bi bi-envelope me-2 text-primary"></i>awaisiqbalch@email.com</li>
                        <li class="mb-2 text-white"><i class="bi bi-telephone me-2 text-primary"></i>+92 333 5071204</li>
                        <li class="text-white"><i class="bi bi-clock me-2 text-primary"></i>Mon - Sat, 9am - 6pm</li>
                    </ul>
                </div>
            </div>
            <hr class="border-secondary mt-4">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <small class="text-white">&copy; {{ date('Y') }} Awais Iqbal Ch. All Rights Reserved.</small>
                </div>
                <div class="col-md-6 text-md-end">
                    <small class="text-white">Designed with <i class="bi bi-heart-fill text-danger"></i> for Education</small>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top -->
    <button class="btn btn-primary btn-back-top" id="backToTop" title="Back to Top">
        <i class="bi bi-arrow-up"></i>
    </button>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // AOS Init
        AOS.init({ duration: 700, once: true });

        // Lightbox
        const lightbox = GLightbox({ touchNavigation: true, loop: true });

        // Back to top
        const backBtn = document.getElementById('backToTop');
        window.addEventListener('scroll', () => {
            backBtn.style.display = window.scrollY > 400 ? 'block' : 'none';
        });
        backBtn.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));
    </script>
    @stack('scripts')
</body>
</html>
