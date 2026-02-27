@extends('layouts.frontend')
@section('title', ($event->meta_title ?? $event->title) . ' | Awais Iqbal Ch')

@section('content')
<section class="page-header py-5 text-white" style="background:linear-gradient(135deg,#1a1a2e,#16213e,#0f3460);">
    <div class="container py-3">
        <nav aria-label="breadcrumb"><ol class="breadcrumb mb-2">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('workshops.index') }}" class="text-white-50">Workshops</a></li>
            <li class="breadcrumb-item active text-white">{{ Str::limit($event->title, 40) }}</li>
        </ol></nav>
        <div class="d-flex flex-wrap gap-2 mb-3">
            <span class="badge {{ $event->status === 'upcoming' ? 'bg-success' : 'bg-secondary' }} fs-6">{{ ucfirst($event->status) }}</span>
            @if($event->is_free)<span class="badge bg-info fs-6">Free Event</span>@endif
            @if($event->is_online)<span class="badge bg-primary fs-6"><i class="bi bi-camera-video me-1"></i>Online</span>@endif
        </div>
        <h1 class="display-5 fw-bold mb-3" style="font-family:'Playfair Display',serif;">{{ $event->title }}</h1>
        <div class="d-flex flex-wrap gap-4 opacity-75 small">
            <span><i class="bi bi-calendar me-2"></i>{{ $event->start_date->format('F d, Y') }}@if($event->end_date) – {{ $event->end_date->format('F d, Y') }}@endif</span>
            <span><i class="bi bi-geo-alt me-2"></i>{{ $event->location }}</span>
            @if(!$event->is_free)<span><i class="bi bi-currency-rupee me-1"></i>PKR {{ number_format($event->price) }}</span>@endif
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row g-5">
            <!-- Event Details -->
            <div class="col-lg-8">
                @if($event->featured_image)
                <img src="{{ $event->featured_image_url }}" alt="{{ $event->title }}" class="img-fluid rounded-3 shadow mb-5 w-100" style="max-height:420px;object-fit:cover;">
                @endif

                <div class="prose" style="font-size:1.05rem;line-height:1.8;">{!! $event->description !!}</div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Event Info Card -->
                <div class="card border-0 shadow-sm rounded-3 p-4 mb-4">
                    <h6 class="fw-bold mb-3">Event Details</h6>
                    <ul class="list-unstyled">
                        <li class="d-flex gap-3 mb-3">
                            <i class="bi bi-calendar-event text-primary mt-1"></i>
                            <div>
                                <div class="fw-semibold small">Date & Time</div>
                                <div class="text-muted small">{{ $event->start_date->format('l, F d, Y') }}</div>
                                @if($event->end_date)<div class="text-muted small">to {{ $event->end_date->format('F d, Y') }}</div>@endif
                            </div>
                        </li>
                        <li class="d-flex gap-3 mb-3">
                            <i class="bi bi-geo-alt text-primary mt-1"></i>
                            <div>
                                <div class="fw-semibold small">Location</div>
                                <div class="text-muted small">{{ $event->location }}</div>
                                @if($event->is_online && $event->online_link)
                                    <a href="{{ $event->online_link }}" target="_blank" class="text-primary small">Join Online</a>
                                @endif
                            </div>
                        </li>
                        <li class="d-flex gap-3 mb-3">
                            <i class="bi bi-people text-primary mt-1"></i>
                            <div>
                                <div class="fw-semibold small">Registrations</div>
                                <div class="text-muted small">{{ $registrationCount }} registered
                                    @if($spotsLeft !== null)
                                        · <span class="{{ $spotsLeft < 10 ? 'text-danger' : 'text-success' }}">{{ $spotsLeft }} spots left</span>
                                    @endif
                                </div>
                            </div>
                        </li>
                        <li class="d-flex gap-3">
                            <i class="bi bi-tag text-primary mt-1"></i>
                            <div>
                                <div class="fw-semibold small">Registration Fee</div>
                                <div class="{{ $event->is_free ? 'text-success' : 'text-dark' }} small fw-semibold">
                                    {{ $event->is_free ? 'FREE' : 'PKR ' . number_format($event->price) }}
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>

                <!-- Registration Form -->
                @if($event->status === 'upcoming')
                <div class="card border-0 shadow-sm rounded-3 p-4">
                    <h6 class="fw-bold mb-3"><i class="bi bi-pencil-square text-primary me-2"></i>Register Now</h6>

                    @if(session('success'))
                        <div class="alert alert-success small py-2"><i class="bi bi-check-circle me-2"></i>{{ session('success') }}</div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger small py-2"><i class="bi bi-x-circle me-2"></i>{{ session('error') }}</div>
                    @endif

                    <form method="POST" action="{{ route('workshops.register', $event->slug) }}">
                        @csrf
                        <div class="mb-3">
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Full Name *" value="{{ old('name') }}" required>
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email Address *" value="{{ old('email') }}" required>
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <input type="tel" name="phone" class="form-control" placeholder="Phone Number" value="{{ old('phone') }}">
                        </div>
                        <div class="mb-3">
                            <input type="text" name="organization" class="form-control" placeholder="School / Organization" value="{{ old('organization') }}">
                        </div>
                        <div class="mb-3">
                            <textarea name="message" class="form-control" rows="2" placeholder="Any questions or special requirements?">{{ old('message') }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-send me-2"></i>Submit Registration
                        </button>
                    </form>
                </div>
                @else
                <div class="card border-0 bg-light rounded-3 p-4 text-center">
                    <i class="bi bi-clock-history text-muted mb-2" style="font-size:2rem;"></i>
                    <p class="text-muted small mb-0">This event has already taken place.</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
