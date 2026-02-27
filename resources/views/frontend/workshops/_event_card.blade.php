{{-- resources/views/frontend/workshops/_event_card.blade.php --}}
<div class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden">
    @if($event->featured_image)
        <img src="{{ $event->featured_image_url }}" class="card-img-top" style="height:200px;object-fit:cover;" alt="{{ $event->title }}">
    @else
        <div style="height:200px;background:linear-gradient(135deg,#e94560,#c0392b);display:flex;align-items:center;justify-content:center;">
            <i class="bi bi-calendar-event text-white" style="font-size:3.5rem;opacity:.6;"></i>
        </div>
    @endif
    <div class="card-body">
        <div class="d-flex flex-wrap gap-1 mb-2">
            <span class="badge {{ isset($isPast) ? 'bg-secondary' : 'bg-success' }}">
                {{ ucfirst($event->status) }}
            </span>
            @if($event->is_free)
                <span class="badge bg-info">Free</span>
            @else
                <span class="badge bg-warning text-dark">PKR {{ number_format($event->price) }}</span>
            @endif
            @if($event->is_online)
                <span class="badge bg-primary">Online</span>
            @endif
        </div>
        <h6 class="card-title fw-bold">{{ $event->title }}</h6>
        <p class="text-muted small mb-3">{{ Str::limit($event->excerpt, 90) }}</p>
        <ul class="list-unstyled small text-muted mb-0">
            <li class="mb-1"><i class="bi bi-calendar me-2 text-primary"></i>{{ $event->start_date->format('M d, Y') }}</li>
            <li><i class="bi bi-geo-alt me-2 text-primary"></i>{{ $event->location }}</li>
        </ul>
    </div>
    <div class="card-footer bg-transparent border-0 pb-3 px-3">
        <a href="{{ route('workshops.show', $event->slug) }}" class="btn btn-primary btn-sm w-100">
            {{ isset($isPast) ? 'View Details' : 'Register Now' }}
        </a>
    </div>
</div>
