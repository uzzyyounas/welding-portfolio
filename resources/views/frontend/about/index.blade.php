@extends('layouts.frontend')

@section('title', 'About Awais Iqbal Ch | Educationist & Motivational Speaker')
@section('meta_description', 'Learn about Awais Iqbal Ch journey as an educationist, certified teacher trainer, and motivational speaker with over 15 years of transformative experience.')

@section('content')

<!-- Page Header -->
<section class="page-header py-5 text-white" style="background:linear-gradient(135deg,#1a1a2e,#16213e,#0f3460);">
    <div class="container py-3">
        <div class="row">
            <div class="col-lg-8">
                <nav aria-label="breadcrumb"><ol class="breadcrumb mb-2"><li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50">Home</a></li><li class="breadcrumb-item active text-white">About</li></ol></nav>
                <h1 class="display-5 fw-bold mb-3" style="font-family:'Playfair Display',serif;">About Me</h1>
                <p class="lead opacity-75">Get to know my story, journey, and the passion that drives me.</p>
            </div>
        </div>
    </div>
</section>

<!-- Biography -->
<section class="py-6 py-5">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-4" data-aos="fade-right">
                <div class="position-relative">
                    <img src="{{ asset('images/awaisiqbal.jpg') }}" alt="Awais Iqbal Ch" class="img-fluid rounded-3 shadow-lg w-100" style="max-height:520px;object-fit:cover;">
                    <div class="position-absolute bottom-0 start-0 end-0 p-4 text-white rounded-bottom-3" style="background:linear-gradient(0deg,rgba(0,0,0,.8),transparent);">
                        <h5 class="mb-0">Awais Iqbal Ch</h5>
                        <small class="opacity-75">PhD | M.Ed | B.Ed (Hons)</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-8" data-aos="fade-left">
                <div class="text-primary fw-semibold small text-uppercase mb-2">Biography</div>
                <h2 class="display-6 mb-4" style="font-family:'Playfair Display',serif;">Empowering Educators, <span class="text-primary">Inspiring Change</span></h2>

                <p class="text-muted mb-3">Awais Iqbal Ch is a nationally recognized educationist, certified teacher trainer, motivational speaker, and digital learning specialist with over 15 years of transformative experience in the field of education. Her work has touched the lives of more than 5,000 educators across Pakistan, Afghanistan, and beyond.</p>

                <p class="text-muted mb-3">Born into a family of educators, Sarah's passion for teaching was ignited early. After completing her Bachelor's in Education with distinction, she spent her early career as a classroom teacher where she developed innovative methodologies for student engagement. Recognizing the need for teacher professional development, she pursued her Master's in Educational Technology and later completed her PhD in Educational Leadership.</p>

                <p class="text-muted mb-4">Today, Dr. Sarah is a sought-after speaker at national and international conferences, a curriculum designer for leading educational institutions, and a dedicated mentor who believes every teacher deserves access to world-class professional development. Her motto: <em>"Teach Less, Inspire More."</em></p>

                <div class="row g-3">
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center gap-3 p-3 bg-light rounded-3">
                            <div class="text-primary fs-4"><i class="bi bi-geo-alt"></i></div>
                            <div><small class="text-muted d-block">Based In</small><span class="fw-semibold">Dahranwala, Punjab, Pakistan</span></div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center gap-3 p-3 bg-light rounded-3">
                            <div class="text-primary fs-4"><i class="bi bi-translate"></i></div>
                            <div><small class="text-muted d-block">Languages</small><span class="fw-semibold">Urdu, English, Punjabi</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Education -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <div class="text-primary fw-semibold small text-uppercase mb-2">Academic Background</div>
            <h2 class="display-6 mb-0" style="font-family:'Playfair Display',serif;">Education & Qualifications</h2>
        </div>
        <div class="row g-4 justify-content-center">
            @foreach($education as $edu)
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="card h-100 border-0 shadow-sm rounded-3 p-4">
                    <div class="text-center mb-3">
                        <div style="width:64px;height:64px;background:linear-gradient(135deg,#e94560,#c0392b);border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.8rem;margin:0 auto;">🎓</div>
                    </div>
                    <div class="text-center">
                        <div class="badge bg-primary mb-2">{{ $edu['year'] }}</div>
                        <h6 class="fw-bold">{{ $edu['degree'] }}</h6>
                        <p class="text-muted small mb-2">{{ $edu['institution'] }}</p>
                        <span class="badge bg-success">{{ $edu['grade'] }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Career Timeline -->
<section class="py-5 bg-white">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <div class="text-primary fw-semibold small text-uppercase mb-2">My Journey</div>
            <h2 class="display-6 mb-0" style="font-family:'Playfair Display',serif;">Career Timeline</h2>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                @foreach($timeline as $item)
                <div class="d-flex gap-4 mb-4" data-aos="fade-up">
                    <div class="flex-shrink-0 text-center">
                        <div style="width:52px;height:52px;background:linear-gradient(135deg,#e94560,#c0392b);border-radius:50%;display:flex;align-items:center;justify-content:center;color:white;font-size:1.1rem;">
                            <i class="bi {{ $item['icon'] }}"></i>
                        </div>
                        @if(!$loop->last)<div class="border-start border-2 border-primary mx-auto" style="width:2px;height:30px;margin-top:6px;"></div>@endif
                    </div>
                    <div class="pb-3">
                        <span class="badge bg-primary mb-1">{{ $item['year'] }}</span>
                        <h6 class="mb-1">{{ $item['title'] }}</h6>
                        <p class="text-muted small mb-0">{{ $item['description'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- Certifications Preview -->
@if($certificates->count())
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <div class="text-primary fw-semibold small text-uppercase mb-2">Credentials</div>
            <h2 class="display-6 mb-3" style="font-family:'Playfair Display',serif;">Key Certifications</h2>
        </div>
        @foreach($certificates as $category => $certs)
        <h6 class="text-muted text-uppercase fw-bold mb-3 small ls-wide">{{ $category ?: 'General' }}</h6>
        <div class="row g-3 mb-4">
            @foreach($certs->take(4) as $cert)
            <div class="col-md-3" data-aos="fade-up">
                <div class="card border-0 shadow-sm rounded-3 p-3 text-center h-100">
                    <div class="text-primary fs-2 mb-2">🏆</div>
                    <div class="fw-semibold small">{{ $cert->title }}</div>
                    <div class="text-muted" style="font-size:.75rem;">{{ $cert->issuing_organization }}</div>
                    <div class="badge bg-light text-dark mt-1">{{ $cert->year }}</div>
                </div>
            </div>
            @endforeach
        </div>
        @endforeach
        <div class="text-center">
            <a href="{{ route('certifications.index') }}" class="btn btn-outline-primary px-5">View All Certifications</a>
        </div>
    </div>
</section>
@endif

@endsection
