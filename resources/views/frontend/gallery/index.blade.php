@extends('layouts.frontend')
@section('title', 'Gallery | Awais Iqbal Ch')

@section('content')
<section class="page-header py-5 text-white" style="background:linear-gradient(135deg,#1a1a2e,#16213e,#0f3460);">
    <div class="container py-3">
        <nav aria-label="breadcrumb"><ol class="breadcrumb mb-2"><li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50">Home</a></li><li class="breadcrumb-item active text-white">Gallery</li></ol></nav>
        <h1 class="display-5 fw-bold mb-2" style="font-family:'Playfair Display',serif;">Media Gallery</h1>
        <p class="lead opacity-75">Moments, workshops, events, and highlights from my journey.</p>
    </div>
</section>

<section class="py-5">
    <div class="container">

        <!-- Filter Tabs -->
        <ul class="nav nav-pills justify-content-center mb-5" id="galleryTabs">
            <li class="nav-item"><button class="nav-link active me-2" data-filter="all">All</button></li>
            <li class="nav-item"><button class="nav-link me-2" data-filter="image">Photos</button></li>
            <li class="nav-item"><button class="nav-link me-2" data-filter="video">Videos</button></li>
            @foreach($categories as $cat)
            <li class="nav-item"><button class="nav-link me-2" data-filter="{{ Str::slug($cat) }}">{{ $cat }}</button></li>
            @endforeach
        </ul>

        <!-- Images Grid -->
        @if($images->count())
        <h5 class="mb-4 text-muted fw-semibold">Photos</h5>
        <div class="row g-3 mb-5" id="imageGrid">
            @foreach($images as $item)
            <div class="col-6 col-md-4 col-lg-3 gallery-item" data-type="image" data-category="{{ Str::slug($item->category) }}" data-aos="fade-up">
                <a href="{{ $item->url }}" class="glightbox" data-gallery="gallery" data-title="{{ $item->title }}" data-description="{{ $item->description }}">
                    <div class="gallery-thumb rounded-3 overflow-hidden" style="aspect-ratio:4/3;background:#f0f2f5;">
                        <img src="{{ $item->thumbnail_url }}" alt="{{ $item->title }}" class="w-100 h-100" style="object-fit:cover;transition:transform .3s;" loading="lazy" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                        <div class="gallery-overlay d-flex align-items-center justify-content-center">
                            <i class="bi bi-zoom-in text-white fs-3"></i>
                        </div>
                    </div>
                </a>
                <p class="small text-muted mt-1 mb-0">{{ $item->title }}</p>
            </div>
            @endforeach
        </div>
        @endif

        <!-- Videos Grid -->
        @if($videos->count())
        <h5 class="mb-4 text-muted fw-semibold">Videos</h5>
        <div class="row g-4">
            @foreach($videos as $item)
            <div class="col-md-6 col-lg-4 gallery-item" data-type="video" data-category="{{ Str::slug($item->category) }}" data-aos="fade-up">
                @php
                    preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^&\s]+)/', $item->video_url, $m);
                    $ytId = $m[1] ?? null;
                @endphp
                <div class="card border-0 shadow-sm rounded-3 overflow-hidden h-100">
                    <div class="position-relative" style="aspect-ratio:16/9;">
                        <img src="{{ $item->thumbnail_url }}" alt="{{ $item->title }}" class="w-100 h-100" style="object-fit:cover;" loading="lazy">
                        <a href="{{ $item->video_url }}" class="glightbox position-absolute inset-0 d-flex align-items-center justify-content-center" data-gallery="videos" data-title="{{ $item->title }}" style="background:rgba(0,0,0,.3);">
                            <div class="bg-danger rounded-circle d-flex align-items-center justify-content-center" style="width:56px;height:56px;">
                                <i class="bi bi-play-fill text-white fs-3 ms-1"></i>
                            </div>
                        </a>
                    </div>
                    <div class="card-body">
                        <h6 class="mb-1">{{ $item->title }}</h6>
                        @if($item->description)<p class="text-muted small mb-0">{{ $item->description }}</p>@endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        @if($images->isEmpty() && $videos->isEmpty())
        <div class="text-center py-5">
            <i class="bi bi-images text-muted" style="font-size:3rem;"></i>
            <p class="text-muted mt-3">Gallery content coming soon.</p>
        </div>
        @endif
    </div>
</section>

@push('styles')
<style>
    .gallery-thumb { position: relative; cursor: pointer; }
    .gallery-overlay { position: absolute; inset: 0; background: rgba(233,69,96,.4); opacity: 0; transition: opacity .3s; }
    .gallery-thumb:hover .gallery-overlay { opacity: 1; }
    .nav-pills .nav-link { color: #495057; background: #f8f9fa; border-radius: 30px; }
    .nav-pills .nav-link.active { background: #e94560; color: white; }
</style>
@endpush

@push('scripts')
<script>
    // Category filter
    document.querySelectorAll('#galleryTabs .nav-link').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('#galleryTabs .nav-link').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            const filter = this.dataset.filter;
            document.querySelectorAll('.gallery-item').forEach(item => {
                if (filter === 'all' || item.dataset.type === filter || item.dataset.category === filter) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
</script>
@endpush
@endsection
