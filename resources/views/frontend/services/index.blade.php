@extends('layouts.frontend')
@section('title', 'Services | Awais Iqbal Ch')

@section('content')
<section class="page-header py-5 text-white" style="background:linear-gradient(135deg,#1a1a2e,#16213e,#0f3460);">
    <div class="container py-3">
        <nav aria-label="breadcrumb"><ol class="breadcrumb mb-2"><li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50">Home</a></li><li class="breadcrumb-item active text-white">Services</li></ol></nav>
        <h1 class="display-5 fw-bold mb-2" style="font-family:'Playfair Display',serif;">Professional Services</h1>
        <p class="lead opacity-75">Tailored programs designed to transform educators and institutions.</p>
    </div>
</section>

<section class="py-5">
    <div class="container">
        @forelse($services as $index => $service)
        <div class="row g-5 align-items-center mb-6 mb-5 {{ $index % 2 !== 0 ? 'flex-row-reverse' : '' }}" data-aos="fade-up">
            <div class="col-lg-5">
                <img src="{{ $service->featured_image_url }}" alt="{{ $service->title }}" class="img-fluid rounded-3 shadow-lg w-100" style="max-height:380px;object-fit:cover;">
            </div>
            <div class="col-lg-7">
                <div class="service-icon-lg mb-3" style="width:64px;height:64px;background:linear-gradient(135deg,#e94560,#c0392b);border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.8rem;color:white;">
                    <i class="bi {{ $service->icon ?? 'bi-star' }}"></i>
                </div>
                <h2 class="mb-3" style="font-family:'Playfair Display',serif;">{{ $service->title }}</h2>
                <p class="text-muted lead">{{ $service->excerpt }}</p>

                @if($service->features)
                <ul class="list-unstyled mt-3">
                    @foreach($service->features as $feature)
                    <li class="d-flex align-items-center gap-2 mb-2">
                        <i class="bi bi-check-circle-fill text-primary"></i>
                        <span>{{ $feature }}</span>
                    </li>
                    @endforeach
                </ul>
                @endif

                <div class="mt-4 d-flex gap-3">
                    <a href="{{ route('services.show', $service->slug) }}" class="btn btn-primary px-4">Learn More</a>
                    <a href="{{ route('contact.index') }}" class="btn btn-outline-primary px-4">Enquire Now</a>
                </div>
            </div>
        </div>
        @empty
        <p class="text-center text-muted py-5">Services coming soon.</p>
        @endforelse
    </div>
</section>

<!-- CTA -->
<section class="py-5 text-white text-center" style="background:linear-gradient(135deg,#e94560,#c0392b);">
    <div class="container">
        <h2 class="mb-3" style="font-family:'Playfair Display',serif;">Ready to Transform Your Institution?</h2>
        <p class="lead opacity-75 mb-4">Let's discuss a customized program for your specific needs.</p>
        <a href="{{ route('contact.index') }}" class="btn btn-light btn-lg px-5 text-primary fw-semibold">Get in Touch</a>
    </div>
</section>
@endsection
