@extends('layouts.frontend')
@section('title', 'Testimonials | Awais Iqbal Ch')

@section('content')
<section class="page-header py-5 text-white" style="background:linear-gradient(135deg,#1a1a2e,#16213e,#0f3460);">
    <div class="container py-3">
        <nav aria-label="breadcrumb"><ol class="breadcrumb mb-2"><li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50">Home</a></li><li class="breadcrumb-item active text-white">Testimonials</li></ol></nav>
        <h1 class="display-5 fw-bold mb-2" style="font-family:'Playfair Display',serif;">What People Say</h1>
        <p class="lead opacity-75">Real stories from educators, institutions, and professionals I've had the privilege to work with.</p>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row g-4">
            @forelse($testimonials as $t)
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 100 }}">
                <div class="card h-100 border-0 shadow-sm rounded-3 p-4">
                    <!-- Stars -->
                    <div class="mb-3" style="color:#f59e0b;font-size:1.1rem;">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="bi {{ $i <= $t->rating ? 'bi-star-fill' : 'bi-star' }}"></i>
                        @endfor
                    </div>

                    <!-- Quote -->
                    <div style="font-size:2.5rem;color:#e9ecef;line-height:1;">"</div>
                    <p class="text-muted fst-italic mb-4" style="font-size:.95rem;line-height:1.7;">{{ $t->content }}</p>

                    <!-- Author -->
                    <div class="d-flex align-items-center gap-3 mt-auto">
                        @if($t->author_image)
                            <img src="{{ asset('storage/'.$t->author_image) }}" class="rounded-circle" width="48" height="48" style="object-fit:cover;" alt="{{ $t->author_name }}">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($t->author_name) }}&background=e94560&color=fff&size=48" class="rounded-circle" width="48" height="48">
                        @endif
                        <div>
                            <div class="fw-semibold">{{ $t->author_name }}</div>
                            <small class="text-muted">
                                {{ $t->author_title }}
                                @if($t->author_organization) · {{ $t->author_organization }} @endif
                            </small>
                        </div>
                    </div>

                    @if($t->video_url)
                    <div class="mt-3 pt-3 border-top">
                        <a href="{{ $t->video_url }}" class="glightbox btn btn-sm btn-outline-primary" data-gallery="testimonials">
                            <i class="bi bi-play-circle me-1"></i> Watch Video Testimonial
                        </a>
                    </div>
                    @endif
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <i class="bi bi-chat-quote text-muted" style="font-size:3rem;"></i>
                <p class="text-muted mt-3">Testimonials coming soon.</p>
            </div>
            @endforelse
        </div>

        <div class="mt-5">{{ $testimonials->links() }}</div>
    </div>
</section>

<!-- CTA -->
<section class="py-5 text-center" style="background:#f8f9fa;">
    <div class="container">
        <h3 class="mb-3" style="font-family:'Playfair Display',serif;">Want to Share Your Experience?</h3>
        <p class="text-muted mb-4">If you've attended a workshop or session and would like to share your feedback, I'd love to hear from you.</p>
        <a href="{{ route('contact.index') }}" class="btn btn-primary px-5">Get in Touch</a>
    </div>
</section>
@endsection
