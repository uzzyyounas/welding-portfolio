@extends('layouts.frontend')

@section('title', 'Awais Iqbal Ch | Educationist, Certified Teacher Trainer & Motivational Speaker, Digital Learning Specialist')
@section('meta_description', 'Awais Iqbal Ch — Empowering educators and inspiring minds. Certified Teacher Trainer, Motivational Speaker, and Digital Learning Specialist based in Pakistan.')

@push('styles')
<style>
    /* Hero Section */
    .hero-section {
        background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
        min-height: 70vh;
        display: flex;
        align-items: center;
        position: relative;
        overflow: hidden;
    }
    .hero-section::before {
        content: '';
        position: absolute;
        inset: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }
    .hero-badge { background: rgba(233,69,96,.15); border: 1px solid rgba(233,69,96,.3); color: #f8a5b3; border-radius: 30px; padding: 6px 16px; font-size: .8rem; display: inline-block; }
    .hero-title { font-family: 'Playfair Display', serif; font-size: clamp(2.5rem, 5vw, 4rem); font-weight: 700; color: #fff; line-height: 1.15; }
    .hero-title span { color: #e94560; }
    .hero-tagline { font-size: 1.1rem; color: rgba(255,255,255,.7); max-width: 520px; }
    .hero-tags .badge { background: rgba(255,255,255,.08); color: rgba(255,255,255,.85); border: 1px solid rgba(255,255,255,.15); padding: 6px 14px; border-radius: 20px; font-size: .8rem; font-weight: 400; }
    .hero-image-wrapper { position: relative; }
    .hero-image-wrapper img { border-radius: 30px 30px 30px 0; box-shadow: 0 30px 80px rgba(0,0,0,.5); }
    .hero-float-card { position: absolute; background: rgba(255,255,255,.1); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,.2); border-radius: 16px; padding: 1rem 1.4rem; color: white; }
    .hero-float-card.card-1 { bottom: 30px; left: -30px; }
    .hero-float-card.card-2 { top: 40px; right: -20px; }

    /* Stats Counter */
    .counter-section { background: #fff; box-shadow: 0 4px 30px rgba(0,0,0,.08); }
    .counter-item { text-align: center; padding: 2rem 1rem; }
    .counter-number { font-size: 3rem; font-weight: 700; color: #e94560; font-family: 'Playfair Display', serif; line-height: 1; }
    .counter-label { color: #6c757d; font-size: .9rem; margin-top: .5rem; }

    /* Services */
    .service-card { background: #fff; border-radius: 16px; padding: 2rem; border: 1px solid #e9ecef; transition: all .3s; height: 100%; }
    .service-card:hover { transform: translateY(-6px); box-shadow: 0 20px 50px rgba(0,0,0,.1); border-color: #e94560; }
    .service-icon { width: 60px; height: 60px; background: linear-gradient(135deg, #e94560, #c0392b); border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; color: white; margin-bottom: 1.2rem; }

    /* Testimonials */
    .testimonial-card { background: #fff; border-radius: 16px; padding: 2rem; border: 1px solid #e9ecef; height: 100%; }
    .stars { color: #f59e0b; }
    .quote-icon { font-size: 3rem; color: #e9ecef; line-height: 1; }

    /* Blog */
    .blog-card { border-radius: 16px; overflow: hidden; border: 1px solid #e9ecef; transition: all .3s; }
    .blog-card:hover { transform: translateY(-4px); box-shadow: 0 16px 40px rgba(0,0,0,.1); }
    .blog-card img { height: 200px; width: 100%; object-fit: cover; }
    .blog-card .card-body { padding: 1.5rem; }

    /* CTA Section */
    .cta-section { background: linear-gradient(135deg, #e94560, #c0392b); }
    .section-title { font-family: 'Playfair Display', serif; font-weight: 700; }
    .section-subtitle { color: #6c757d; }
    .divider { width: 60px; height: 4px; background: #e94560; border-radius: 2px; }
</style>
@endpush

@section('content')

<!-- ===================== HERO ===================== -->
<section class="hero-section">
    <div class="container py-5">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="hero-badge mb-3"><i class="bi bi-star-fill me-1"></i> Top Educationist 2026</div>
                <h1 class="hero-title mb-3">
                    <span>Awais</span> Iqbal Ch
                </h1>
                <p class="hero-tagline mb-4">
                    Empowering educators, inspiring learners, and transforming classrooms through evidence-based training and motivational excellence.
                </p>
                <div class="hero-tags d-flex flex-wrap gap-2 mb-4">
                    <span class="badge"><i class="bi bi-mortarboard me-1"></i> Educationist</span>
                    <span class="badge"><i class="bi bi-award me-1"></i> Certified Trainer</span>
                    <span class="badge"><i class="bi bi-mic me-1"></i> Speaker</span>
                    <span class="badge"><i class="bi bi-laptop me-1"></i> Digital Learning</span>
                </div>
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('about') }}" class="btn btn-light btn-lg px-5">Discover My Story</a>
                    <a href="{{ route('contact.index') }}" class="btn btn-outline-light btn-lg px-5">Book a Session</a>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <div class="hero-image-wrapper text-center">
                    <img src="{{ asset('images/awaisiqbal.jpg') }}" alt="Awais Iqbal Ch" class="img-fluid" style="max-height:520px;object-fit:cover;">
                    <div class="hero-float-card card-1">
                        <div class="d-flex align-items-center gap-3">
                            <div style="width:42px;height:42px;background:linear-gradient(135deg,#e94560,#c0392b);border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:1.2rem;">🎓</div>
                            <div>
                                <div class="fw-bold">5,000+</div>
                                <small style="color:rgba(255,255,255,.7)">Teachers Trained</small>
                            </div>
                        </div>
                    </div>
                    <div class="hero-float-card card-2">
                        <div class="d-flex align-items-center gap-3">
                            <div style="width:42px;height:42px;background:linear-gradient(135deg,#f59e0b,#e68a00);border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:1.2rem;">⭐</div>
                            <div>
                                <div class="fw-bold">4.9/5</div>
                                <small style="color:rgba(255,255,255,.7)">Rating Score</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Scroll indicator -->
    <div class="position-absolute bottom-0 start-50 translate-middle-x pb-3">
        <a href="#stats" class="text-white opacity-50"><i class="bi bi-chevron-double-down fs-4 animate-bounce"></i></a>
    </div>
</section>

<!-- ===================== STATS COUNTER ===================== -->
<section class="counter-section py-4" id="stats">
    <div class="container">
        <div class="row g-0 divide-x">
            @foreach([
                ['number' => $stats['years_experience'], 'suffix' => '+', 'label' => 'Years of Experience', 'icon' => '📅'],
                ['number' => $stats['students_trained'], 'suffix' => '+', 'label' => 'Teachers Trained', 'icon' => '👩‍🏫'],
                ['number' => $stats['workshops_conducted'], 'suffix' => '+', 'label' => 'Workshops Conducted', 'icon' => '🎯'],
                ['number' => $stats['certifications'], 'suffix' => '+', 'label' => 'Certifications Earned', 'icon' => '🏆'],
            ] as $stat)
            <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="counter-item">
                    <div class="fs-2 mb-1">{{ $stat['icon'] }}</div>
                    <div class="counter-number" data-target="{{ $stat['number'] }}">0</div>
                    <div class="counter-number d-inline text-muted fs-4">{{ $stat['suffix'] }}</div>
                    <div class="counter-label">{{ $stat['label'] }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ===================== ABOUT SUMMARY ===================== -->
<section class="py-6 py-5" style="background:#f8f9fa;">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-5" data-aos="fade-right">
                <div class="position-relative">
                    <img src="{{ asset('images/awaisiqbal.jpg') }}" alt="About Dr. Sarah" class="img-fluid rounded-3 shadow-lg">
                    <div class="position-absolute top-0 start-0 m-n3 bg-primary text-white p-3 rounded-3 shadow" style="transform:translate(-15px,-15px);">
                        <div class="fw-bold fs-4">15+</div>
                        <small>Years Experience</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-7" data-aos="fade-left">
                <div class="section-label text-primary fw-semibold mb-2 small text-uppercase ls-wide">About Me</div>
                <h2 class="section-title display-6 mb-4">Transforming Education, <br><span class="text-primary">One Teacher at a Time</span></h2>
                <p class="text-muted mb-3">With over 15 years of hands-on experience in education, I have dedicated my career to empowering teachers and revolutionizing learning environments. My journey began as a classroom teacher and evolved into a mission to transform educational systems at scale.</p>
                <p class="text-muted mb-4">As a PhD holder in Educational Leadership, I combine research-based methodologies with practical, real-world strategies that teachers can implement immediately. My training programs have reached over 5,000 educators across Pakistan and beyond.</p>
                <div class="row g-3 mb-4">
                    @foreach(['Teacher Trainer', 'Motivational Speaker', 'Digital Learning', 'PhD Education'] as $skill)
                    <div class="col-6">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-check-circle-fill text-primary"></i>
                            <span class="small">{{ $skill }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
                <a href="{{ route('about') }}" class="btn btn-primary px-4">Read Full Biography <i class="bi bi-arrow-right ms-1"></i></a>
            </div>
        </div>
    </div>
</section>

<!-- ===================== SERVICES ===================== -->
<section class="py-5 bg-white">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <div class="text-primary fw-semibold small text-uppercase mb-2">What I Offer</div>
            <h2 class="section-title display-6 mb-3">Professional Services</h2>
            <div class="divider mx-auto mb-3"></div>
            <p class="text-muted mx-auto" style="max-width:500px;">Tailored programs designed to inspire, train, and transform educators and organizations.</p>
        </div>
        <div class="row g-4">
            @forelse($services as $service)
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="bi {{ $service->icon ?? 'bi-star' }}"></i>
                    </div>
                    <h5 class="mb-2">{{ $service->title }}</h5>
                    <p class="text-muted small mb-3">{{ $service->excerpt }}</p>
                    <a href="{{ route('services.show', $service->slug) }}" class="text-primary small fw-semibold text-decoration-none">
                        Learn More <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
            @empty
            @foreach([
                ['icon'=>'bi-mortarboard','title'=>'Teacher Training','excerpt'=>'Comprehensive professional development programs that transform teaching practices.'],
                ['icon'=>'bi-mic','title'=>'Motivational Speaking','excerpt'=>'Inspiring keynotes and talks that motivate individuals to unlock their potential.'],
                ['icon'=>'bi-laptop','title'=>'Digital Learning','excerpt'=>'Cutting-edge EdTech strategies for 21st-century classrooms and institutions.'],
                ['icon'=>'bi-people','title'=>'Education Consultancy','excerpt'=>'Strategic guidance for educational institutions to enhance outcomes.'],
            ] as $i => $s)
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
                <div class="service-card">
                    <div class="service-icon"><i class="bi {{ $s['icon'] }}"></i></div>
                    <h5 class="mb-2">{{ $s['title'] }}</h5>
                    <p class="text-muted small mb-3">{{ $s['excerpt'] }}</p>
                    <a href="{{ route('services.index') }}" class="text-primary small fw-semibold text-decoration-none">Learn More <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
            @endforeach
            @endforelse
        </div>
        <div class="text-center mt-5">
            <a href="{{ route('services.index') }}" class="btn btn-outline-primary px-5">View All Services</a>
        </div>
    </div>
</section>

<!-- ===================== UPCOMING EVENTS ===================== -->
@if($upcomingEvents->count())
<section class="py-5" style="background:#f8f9fa;">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <div class="text-primary fw-semibold small text-uppercase mb-2">Don't Miss Out</div>
            <h2 class="section-title display-6 mb-3">Upcoming Workshops & Events</h2>
            <div class="divider mx-auto"></div>
        </div>
        <div class="row g-4">
            @foreach($upcomingEvents as $event)
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden">
                    @if($event->featured_image)
                    <img src="{{ $event->featured_image_url }}" class="card-img-top" style="height:180px;object-fit:cover;" alt="{{ $event->title }}">
                    @else
                    <div style="height:180px;background:linear-gradient(135deg,#e94560,#c0392b);display:flex;align-items:center;justify-content:center;">
                        <i class="bi bi-calendar-event text-white" style="font-size:3rem;"></i>
                    </div>
                    @endif
                    <div class="card-body">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <span class="badge bg-primary">{{ $event->status }}</span>
                            @if($event->is_free)<span class="badge bg-success">Free</span>@endif
                        </div>
                        <h6 class="card-title">{{ $event->title }}</h6>
                        <p class="text-muted small mb-2"><i class="bi bi-calendar me-1"></i>{{ $event->start_date->format('M d, Y') }}</p>
                        <p class="text-muted small"><i class="bi bi-geo-alt me-1"></i>{{ $event->location }}</p>
                    </div>
                    <div class="card-footer bg-transparent border-0 pb-3">
                        <a href="{{ route('workshops.show', $event->slug) }}" class="btn btn-primary btn-sm w-100">View Details</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-4">
            <a href="{{ route('workshops.index') }}" class="btn btn-outline-primary px-5">See All Events</a>
        </div>
    </div>
</section>
@endif

<!-- ===================== TESTIMONIALS ===================== -->
<section class="py-5 bg-white">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <div class="text-primary fw-semibold small text-uppercase mb-2">What People Say</div>
            <h2 class="section-title display-6 mb-3">Testimonials</h2>
            <div class="divider mx-auto"></div>
        </div>

        @if($testimonials->count())
        <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach($testimonials->chunk(3) as $chunkIndex => $chunk)
                <div class="carousel-item {{ $chunkIndex === 0 ? 'active' : '' }}">
                    <div class="row g-4">
                        @foreach($chunk as $testimonial)
                        <div class="col-md-4">
                            <div class="testimonial-card">
                                <div class="quote-icon">"</div>
                                <p class="text-muted small fst-italic mb-3">{{ Str::limit($testimonial->content, 180) }}</p>
                                <div class="stars mb-2">{{ $testimonial->stars }}</div>
                                <div class="d-flex align-items-center gap-3 mt-3">
                                    @if($testimonial->author_image)
                                    <img src="{{ asset('storage/'.$testimonial->author_image) }}" class="rounded-circle" width="44" height="44" style="object-fit:cover;">
                                    @else
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($testimonial->author_name) }}&background=e94560&color=fff&size=44" class="rounded-circle" width="44" height="44">
                                    @endif
                                    <div>
                                        <div class="fw-semibold small">{{ $testimonial->author_name }}</div>
                                        <small class="text-muted">{{ $testimonial->author_title }}@if($testimonial->author_organization), {{ $testimonial->author_organization }}@endif</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev" style="width:40px;left:-50px;">
                <span class="bg-primary rounded-circle p-2"><i class="bi bi-chevron-left text-white"></i></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next" style="width:40px;right:-50px;">
                <span class="bg-primary rounded-circle p-2"><i class="bi bi-chevron-right text-white"></i></span>
            </button>
        </div>
        @else
        <p class="text-center text-muted">Testimonials coming soon.</p>
        @endif
    </div>
</section>

<!-- ===================== LATEST BLOG ===================== -->
@if($latestPosts->count())
<section class="py-5" style="background:#f8f9fa;">
    <div class="container">
        <div class="d-flex justify-content-between align-items-end mb-5">
            <div data-aos="fade-right">
                <div class="text-primary fw-semibold small text-uppercase mb-2">Knowledge & Insights</div>
                <h2 class="section-title display-6 mb-0">Latest from the Blog</h2>
            </div>
            <a href="{{ route('blog.index') }}" class="btn btn-outline-primary" data-aos="fade-left">View All Posts</a>
        </div>
        <div class="row g-4">
            @foreach($latestPosts as $post)
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="blog-card card h-100">
                    <img src="{{ $post->featured_image_url }}" alt="{{ $post->title }}" loading="lazy">
                    <div class="card-body">
                        @if($post->category)
                        <span class="badge bg-primary mb-2">{{ $post->category->name }}</span>
                        @endif
                        <h6 class="card-title">{{ $post->title }}</h6>
                        <p class="text-muted small">{{ Str::limit($post->excerpt, 120) }}</p>
                    </div>
                    <div class="card-footer bg-transparent border-top d-flex justify-content-between align-items-center">
                        <small class="text-muted">{{ $post->published_at?->format('M d, Y') }}</small>
                        <a href="{{ route('blog.show', $post->slug) }}" class="text-primary small fw-semibold">Read More →</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- ===================== CTA SECTION ===================== -->
    {{--<section class="cta-section py-6 py-5 text-white">--}}
    {{--    <div class="container">--}}
    {{--        <div class="row align-items-center">--}}
    {{--            <div class="col-lg-8 mb-4 mb-lg-0" data-aos="fade-right">--}}
    {{--                <h2 class="display-6 fw-bold mb-2">Ready to Transform Your Teaching?</h2>--}}
    {{--                <p class="opacity-75 mb-0 lead">Let's work together to unlock your full potential as an educator.</p>--}}
    {{--            </div>--}}
    {{--            <div class="col-lg-4 text-lg-end" data-aos="fade-left">--}}
    {{--                <a href="{{ route('contact.index') }}" class="btn btn-light btn-lg px-5 me-3 text-primary fw-semibold">Get In Touch</a>--}}
    {{--                <a href="{{ route('workshops.index') }}" class="btn btn-outline-light btn-lg px-4">Join Workshop</a>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
    {{--</section>--}}

@endsection

@push('scripts')
<script>
// Animated Counter
document.addEventListener('DOMContentLoaded', function() {
    const counters = document.querySelectorAll('.counter-number[data-target]');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const target = parseInt(entry.target.getAttribute('data-target'));
                let current = 0;
                const increment = Math.ceil(target / 60);
                const timer = setInterval(() => {
                    current += increment;
                    if (current >= target) { current = target; clearInterval(timer); }
                    entry.target.textContent = current.toLocaleString();
                }, 30);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });
    counters.forEach(c => observer.observe(c));
});
</script>
@endpush
