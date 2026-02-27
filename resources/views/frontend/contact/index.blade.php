@extends('layouts.frontend')
@section('title', 'Contact Awais Iqbal Ch | Book a Session')

@section('content')
<section class="page-header py-5 text-white" style="background:linear-gradient(135deg,#1a1a2e,#16213e,#0f3460);">
    <div class="container py-3">
        <nav aria-label="breadcrumb"><ol class="breadcrumb mb-2"><li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50">Home</a></li><li class="breadcrumb-item active text-white">Contact</li></ol></nav>
        <h1 class="display-5 fw-bold mb-2" style="font-family:'Playfair Display',serif;">Get In Touch</h1>
        <p class="lead opacity-75">Let's discuss how I can help you achieve your educational goals.</p>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row g-5">
            <!-- Contact Info -->
            <div class="col-lg-4" data-aos="fade-right">
                <h4 class="mb-4" style="font-family:'Playfair Display',serif;">Contact Information</h4>

                @foreach([
                    ['icon'=>'bi-geo-alt','title'=>'Location','value'=>'Dahranwala, Punjab, Pakistan'],
                    ['icon'=>'bi-envelope','title'=>'Email','value'=>'awaisiqbalch@email.com'],
                    ['icon'=>'bi-telephone','title'=>'Phone','value'=>'+92 333 5071204'],
                    ['icon'=>'bi-clock','title'=>'Working Hours','value'=>'Mon - Sat, 9:00 AM - 6:00 PM'],
                ] as $info)
                <div class="d-flex gap-3 mb-4">
                    <div style="width:48px;height:48px;background:linear-gradient(135deg,#e94560,#c0392b);border-radius:12px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <i class="bi {{ $info['icon'] }} text-white fs-5"></i>
                    </div>
                    <div>
                        <div class="text-muted small">{{ $info['title'] }}</div>
                        <div class="fw-semibold">{{ $info['value'] }}</div>
                    </div>
                </div>
                @endforeach

                <!-- Social Links -->
                <h6 class="mt-4 mb-3">Follow Me</h6>
                <div class="d-flex flex-wrap gap-2">
                    @foreach([
                        ['icon'=>'bi-facebook','label'=>'Facebook','url'=>'#','color'=>'#1877f2'],
                        ['icon'=>'bi-twitter-x','label'=>'Twitter','url'=>'#','color'=>'#000'],
                        ['icon'=>'bi-linkedin','label'=>'LinkedIn','url'=>'#','color'=>'#0077b5'],
                        ['icon'=>'bi-youtube','label'=>'YouTube','url'=>'#','color'=>'#ff0000'],
                        ['icon'=>'bi-instagram','label'=>'Instagram','url'=>'#','color'=>'#e1306c'],
                    ] as $social)
                    <a href="{{ $social['url'] }}" class="btn btn-outline-secondary" style="width:44px;height:44px;padding:0;display:flex;align-items:center;justify-content:center;border-radius:10px;" title="{{ $social['label'] }}">
                        <i class="bi {{ $social['icon'] }}"></i>
                    </a>
                    @endforeach
                </div>

                <!-- Map -->
                <div class="mt-4 rounded-3 overflow-hidden">
                    <iframe src="https://maps.google.com/maps?q=Lahore+Pakistan&output=embed" width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="col-lg-8" data-aos="fade-left">
                <div class="card border-0 shadow-sm rounded-3 p-4 p-md-5">
                    <h4 class="mb-4" style="font-family:'Playfair Display',serif;">Send Me a Message</h4>

                    @if(session('success'))
                    <div class="alert alert-success d-flex align-items-center gap-2">
                        <i class="bi bi-check-circle-fill fs-5"></i>
                        {{ session('success') }}
                    </div>
                    @endif

                    <form method="POST" action="{{ route('contact.store') }}">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Your Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control form-control-lg @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Usman Younas" required>
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Email Address <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control form-control-lg @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="uzzy.younas@gmail.com" required>
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Phone Number</label>
                                <input type="tel" name="phone" class="form-control form-control-lg" value="{{ old('phone') }}" placeholder="+92-306-1745031">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Subject <span class="text-danger">*</span></label>
                                <select name="subject" class="form-select form-select-lg @error('subject') is-invalid @enderror" required>
                                    <option value="">Select a subject...</option>
                                    <option value="Teacher Training Inquiry" {{ old('subject') == 'Teacher Training Inquiry' ? 'selected' : '' }}>Teacher Training Inquiry</option>
                                    <option value="Motivational Speaking" {{ old('subject') == 'Motivational Speaking' ? 'selected' : '' }}>Motivational Speaking</option>
                                    <option value="Workshop Registration" {{ old('subject') == 'Workshop Registration' ? 'selected' : '' }}>Workshop Registration</option>
                                    <option value="Digital Learning Consultancy" {{ old('subject') == 'Digital Learning Consultancy' ? 'selected' : '' }}>Digital Learning Consultancy</option>
                                    <option value="Media & Press" {{ old('subject') == 'Media & Press' ? 'selected' : '' }}>Media & Press</option>
                                    <option value="Other" {{ old('subject') == 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                                @error('subject')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold">Message <span class="text-danger">*</span></label>
                                <textarea name="message" class="form-control @error('message') is-invalid @enderror" rows="6" placeholder="Tell me about your project, question, or how I can help you..." required>{{ old('message') }}</textarea>
                                @error('message')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-lg px-5">
                                    <i class="bi bi-send me-2"></i>Send Message
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
