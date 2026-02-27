@extends('layouts.frontend')
@section('title', 'Certifications & Achievements | Awais Iqbal Ch')

@section('content')
<section class="page-header py-5 text-white" style="background:linear-gradient(135deg,#1a1a2e,#16213e,#0f3460);">
    <div class="container py-3">
        <nav aria-label="breadcrumb"><ol class="breadcrumb mb-2"><li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50">Home</a></li><li class="breadcrumb-item active text-white">Certifications</li></ol></nav>
        <h1 class="display-5 fw-bold mb-2" style="font-family:'Playfair Display',serif;">Certifications & Achievements</h1>
        <p class="lead opacity-75">A lifetime of learning, formally recognized by leading institutions worldwide.</p>
    </div>
</section>

<!-- Stats Bar -->
<section class="py-4 bg-white shadow-sm">
    <div class="container">
        <div class="row text-center g-4">
            @foreach([
                ['number' => $stats['total_certificates'], 'label' => 'Certifications'],
                ['number' => $stats['organizations'], 'label' => 'Issuing Organizations'],
                ['number' => $stats['years_active'], 'label' => 'Years in Education'],
            ] as $stat)
            <div class="col-4">
                <div class="fw-bold fs-2" style="color:#e94560;font-family:'Playfair Display',serif;">{{ $stat['number'] }}+</div>
                <div class="text-muted small">{{ $stat['label'] }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        @forelse($certificates as $category => $certs)
        <div class="mb-5" data-aos="fade-up">
            <div class="d-flex align-items-center gap-3 mb-4">
                <div style="width:42px;height:42px;background:linear-gradient(135deg,#e94560,#c0392b);border-radius:10px;display:flex;align-items:center;justify-content:center;color:white;font-size:1.2rem;">🏆</div>
                <h4 class="mb-0" style="font-family:'Playfair Display',serif;">{{ $category ?: 'General' }}</h4>
            </div>
            <div class="row g-4">
                @foreach($certs as $cert)
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 4) * 80 }}">
                    <div class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden cert-card">
                        @if($cert->certificate_image)
                        <a href="{{ $cert->image_url }}" class="glightbox" data-title="{{ $cert->title }}" data-gallery="certificates">
                            <img src="{{ $cert->image_url }}" alt="{{ $cert->title }}" class="card-img-top" style="height:180px;object-fit:cover;">
                        </a>
                        @else
                        <div style="height:140px;background:linear-gradient(135deg,#f8f9fa,#e9ecef);display:flex;align-items:center;justify-content:center;">
                            <span style="font-size:3.5rem;">🎓</span>
                        </div>
                        @endif
                        <div class="card-body text-center">
                            <div class="badge bg-primary mb-2">{{ $cert->year }}</div>
                            <h6 class="fw-bold mb-1">{{ $cert->title }}</h6>
                            <p class="text-muted small mb-2">{{ $cert->issuing_organization }}</p>
                            @if($cert->description)
                                <p class="text-muted" style="font-size:.8rem;">{{ Str::limit($cert->description, 80) }}</p>
                            @endif
                            @if($cert->credential_url)
                                <a href="{{ $cert->credential_url }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-box-arrow-up-right me-1"></i>Verify
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @empty
        <div class="text-center py-5">
            <i class="bi bi-award text-muted" style="font-size:3rem;"></i>
            <p class="text-muted mt-3">Certifications coming soon.</p>
        </div>
        @endforelse
    </div>
</section>

@push('styles')
<style>
    .cert-card { transition: all .3s; }
    .cert-card:hover { transform: translateY(-5px); box-shadow: 0 16px 40px rgba(0,0,0,.12) !important; }
</style>
@endpush
@endsection
