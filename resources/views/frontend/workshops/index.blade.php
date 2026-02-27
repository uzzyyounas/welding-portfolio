@extends('layouts.frontend')
@section('title', 'Workshops & Events | Awais Iqbal Ch')

@section('content')
<section class="page-header py-5 text-white" style="background:linear-gradient(135deg,#1a1a2e,#16213e,#0f3460);">
    <div class="container py-3">
        <nav aria-label="breadcrumb"><ol class="breadcrumb mb-2"><li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50">Home</a></li><li class="breadcrumb-item active text-white">Workshops & Events</li></ol></nav>
        <h1 class="display-5 fw-bold mb-2" style="font-family:'Playfair Display',serif;">Workshops & Events</h1>
        <p class="lead opacity-75">Join live training sessions, webinars, and professional development workshops.</p>
    </div>
</section>

<section class="py-5">
    <div class="container">

        <!-- Tabs -->
        <ul class="nav nav-pills mb-5 justify-content-center" id="eventTabs">
            <li class="nav-item"><a class="nav-link active px-4 me-2" href="#upcoming" data-bs-toggle="tab">Upcoming Events</a></li>
            <li class="nav-item"><a class="nav-link px-4" href="#past" data-bs-toggle="tab">Past Events</a></li>
        </ul>

        <div class="tab-content">
            <!-- Upcoming Events -->
            <div class="tab-pane fade show active" id="upcoming">
                @if($upcomingEvents->isEmpty())
                    <div class="text-center py-5">
                        <i class="bi bi-calendar-x text-muted" style="font-size:3rem;"></i>
                        <p class="text-muted mt-3">No upcoming events at this time. Check back soon!</p>
                    </div>
                @else
                    <div class="row g-4">
                        @foreach($upcomingEvents as $event)
                        <div class="col-md-6 col-lg-4" data-aos="fade-up">
                            @include('frontend.workshops._event_card', ['event' => $event])
                        </div>
                        @endforeach
                    </div>
                    <div class="mt-4">{{ $upcomingEvents->links() }}</div>
                @endif
            </div>

            <!-- Past Events -->
            <div class="tab-pane fade" id="past">
                @if($pastEvents->isEmpty())
                    <div class="text-center py-5">
                        <i class="bi bi-clock-history text-muted" style="font-size:3rem;"></i>
                        <p class="text-muted mt-3">No past events recorded yet.</p>
                    </div>
                @else
                    <div class="row g-4">
                        @foreach($pastEvents as $event)
                        <div class="col-md-6 col-lg-4" data-aos="fade-up">
                            @include('frontend.workshops._event_card', ['event' => $event, 'isPast' => true])
                        </div>
                        @endforeach
                    </div>
                    <div class="mt-4">{{ $pastEvents->links() }}</div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
