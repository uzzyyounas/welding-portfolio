@extends('layouts.admin')
@section('title', 'Dashboard')
@section('breadcrumb')
<li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1 fw-bold">Dashboard</h4>
        <p class="text-muted mb-0 small">Welcome back, Here's what's happening.</p>
    </div>
    <div class="text-muted small"><i class="bi bi-calendar me-1"></i>{{ now()->format('l, F d, Y') }}</div>
</div>

<!-- Stats Grid -->
<div class="row g-4 mb-5">
    @foreach([
        ['icon'=>'bi-file-earmark-richtext','label'=>'Total Posts','value'=>$stats['total_posts'],'sub'=>$stats['published_posts'].' published','color'=>'bg-primary'],
        ['icon'=>'bi-calendar-event','label'=>'Events','value'=>$stats['total_events'],'sub'=>$stats['upcoming_events'].' upcoming','color'=>'bg-success'],
        ['icon'=>'bi-envelope','label'=>'Messages','value'=>$stats['unread_messages'],'sub'=>'unread','color'=>'bg-danger'],
        ['icon'=>'bi-megaphone','label'=>'Subscribers','value'=>$stats['total_subscribers'],'sub'=>'newsletter','color'=>'bg-warning'],
        ['icon'=>'bi-chat-quote','label'=>'Testimonials','value'=>$stats['total_testimonials'],'sub'=>'reviews','color'=>'bg-info'],
        ['icon'=>'bi-people','label'=>'Registrations','value'=>$stats['total_registrations'],'sub'=>'event registrations','color'=>'bg-secondary'],
    ] as $stat)
    <div class="col-6 col-md-4 col-xl-2">
        <div class="stat-card h-100">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="stat-icon {{ $stat['color'] }} bg-opacity-10">
                    <i class="bi {{ $stat['icon'] }} text-{{ str_replace('bg-','',$stat['color']) }}"></i>
                </div>
            </div>
            <div class="h4 fw-bold mb-0">{{ number_format($stat['value']) }}</div>
            <div class="fw-semibold small mb-1">{{ $stat['label'] }}</div>
            <div class="text-muted" style="font-size:.72rem;">{{ $stat['sub'] }}</div>
        </div>
    </div>
    @endforeach
</div>

<div class="row g-4">
    <!-- Recent Messages -->
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-header bg-transparent d-flex justify-content-between align-items-center pt-4 px-4">
                <h6 class="fw-bold mb-0">Recent Messages</h6>
                <a href="{{ route('admin.messages.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="card-body px-4">
                @forelse($recentMessages as $msg)
                <div class="d-flex gap-3 py-3 border-bottom {{ !$msg->is_read ? 'fw-semibold' : '' }}">
                    <div class="stat-icon bg-primary bg-opacity-10" style="min-width:40px;height:40px;">
                        <i class="bi bi-person text-primary"></i>
                    </div>
                    <div class="flex-grow-1 min-w-0">
                        <div class="d-flex justify-content-between">
                            <span class="small">{{ $msg->name }}</span>
                            <small class="text-muted">{{ $msg->created_at->diffForHumans() }}</small>
                        </div>
                        <div class="text-muted small text-truncate">{{ $msg->subject }}</div>
                    </div>
                    @if(!$msg->is_read)<span class="badge bg-danger">New</span>@endif
                </div>
                @empty
                <p class="text-muted text-center py-3 small">No messages yet.</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Recent Posts -->
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-header bg-transparent d-flex justify-content-between align-items-center pt-4 px-4">
                <h6 class="fw-bold mb-0">Recent Posts</h6>
                <a href="{{ route('admin.posts.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="card-body px-4">
                @forelse($recentPosts as $post)
                <div class="d-flex gap-3 py-3 border-bottom align-items-center">
                    <div class="flex-grow-1 min-w-0">
                        <div class="small fw-semibold text-truncate">{{ $post->title }}</div>
                        <div class="d-flex gap-2 mt-1">
                            <span class="badge {{ $post->is_published ? 'bg-success' : 'bg-secondary' }}" style="font-size:.65rem;">{{ $post->is_published ? 'Published' : 'Draft' }}</span>
                            @if($post->category)<span class="badge bg-light text-dark" style="font-size:.65rem;">{{ $post->category->name }}</span>@endif
                        </div>
                    </div>
                    <div class="d-flex gap-1">
                        <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-sm btn-light"><i class="bi bi-pencil"></i></a>
                    </div>
                </div>
                @empty
                <p class="text-muted text-center py-3 small">No posts yet.</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Upcoming Events -->
    <div class="col-12">
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-header bg-transparent d-flex justify-content-between align-items-center pt-4 px-4">
                <h6 class="fw-bold mb-0">Upcoming Events</h6>
                <a href="{{ route('admin.events.index') }}" class="btn btn-sm btn-outline-primary">Manage Events</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="px-4">Event</th>
                            <th>Date</th>
                            <th>Location</th>
                            <th>Status</th>
                            <th>Registrations</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($upcomingEvents as $event)
                        <tr>
                            <td class="px-4 fw-semibold">{{ $event->title }}</td>
                            <td><small>{{ $event->start_date->format('M d, Y') }}</small></td>
                            <td><small class="text-muted">{{ $event->location }}</small></td>
                            <td><span class="badge bg-success">{{ $event->status }}</span></td>
                            <td><span class="badge bg-primary">{{ $event->registrations_count ?? 0 }}</span></td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center text-muted py-4">No upcoming events.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
