@extends('layouts.frontend')
@section('title', ($service->meta_title ?? $service->title) . ' | Awais Iqbal Ch')

@section('content')
<section class="page-header py-5 text-white" style="background:linear-gradient(135deg,#1a1a2e,#16213e,#0f3460);">
    <div class="container py-3">
        <nav aria-label="breadcrumb"><ol class="breadcrumb mb-2">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('services.index') }}" class="text-white-50">Services</a></li>
            <li class="breadcrumb-item active text-white">{{ $service->title }}</li>
        </ol></nav>
        <div class="d-flex align-items-center gap-3 mb-3">
            <div style="width:56px;height:56px;background:rgba(255,255,255,.1);border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.5rem;color:white;">
                <i class="bi {{ $service->icon ?? 'bi-star' }}"></i>
            </div>
            <h1 class="display-6 fw-bold mb-0" style="font-family:'Playfair Display',serif;">{{ $service->title }}</h1>
        </div>
        <p class="lead opacity-75">{{ $service->excerpt }}</p>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row g-5">
            <!-- Main Content -->
            <div class="col-lg-8">
                @if($service->featured_image)
                <img src="{{ $service->featured_image_url }}" alt="{{ $service->title }}" class="img-fluid rounded-3 shadow mb-5 w-100" style="max-height:400px;object-fit:cover;">
                @endif
                <div class="prose" style="font-size:1.05rem;line-height:1.8;">{!! $service->description !!}</div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                @if($service->features)
                <div class="card border-0 shadow-sm rounded-3 p-4 mb-4">
                    <h6 class="fw-bold mb-3"><i class="bi bi-check2-all text-primary me-2"></i>Key Features</h6>
                    <ul class="list-unstyled mb-0">
                        @foreach($service->features as $feature)
                        <li class="d-flex align-items-start gap-2 mb-2">
                            <i class="bi bi-check-circle-fill text-success mt-1 flex-shrink-0"></i>
                            <span class="small">{{ $feature }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @if($service->deliverables)
                <div class="card border-0 shadow-sm rounded-3 p-4 mb-4">
                    <h6 class="fw-bold mb-3"><i class="bi bi-box-seam text-primary me-2"></i>What You'll Receive</h6>
                    <ul class="list-unstyled mb-0">
                        @foreach($service->deliverables as $item)
                        <li class="d-flex align-items-start gap-2 mb-2">
                            <i class="bi bi-arrow-right-circle-fill text-primary mt-1 flex-shrink-0"></i>
                            <span class="small">{{ $item }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <!-- CTA Card -->
                <div class="card border-0 rounded-3 p-4 text-white" style="background:linear-gradient(135deg,#e94560,#c0392b);">
                    <h6 class="fw-bold mb-2">Interested in This Service?</h6>
                    <p class="small opacity-75 mb-3">Get in touch to discuss how we can customize this program for your needs.</p>
                    <a href="{{ route('contact.index') }}" class="btn btn-light text-primary fw-semibold w-100">Book a Consultation</a>
                </div>

                @if($otherServices->count())
                <div class="card border-0 shadow-sm rounded-3 p-4 mt-4">
                    <h6 class="fw-bold mb-3">Other Services</h6>
                    @foreach($otherServices as $other)
                    <a href="{{ route('services.show', $other->slug) }}" class="d-flex align-items-center gap-3 py-2 text-decoration-none text-dark border-bottom">
                        <div style="width:36px;height:36px;background:linear-gradient(135deg,#e94560,#c0392b);border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <i class="bi {{ $other->icon ?? 'bi-star' }} text-white small"></i>
                        </div>
                        <span class="small fw-semibold">{{ $other->title }}</span>
                    </a>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
