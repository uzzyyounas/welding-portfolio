@extends('layouts.admin')
@section('title', 'Events')
@section('breadcrumb')<li class="breadcrumb-item active">Events</li>@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Workshops & Events</h4>
    <a href="{{ route('admin.events.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-2"></i>Add Event</a>
</div>

<div class="card border-0 shadow-sm rounded-3">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr><th class="px-4">Event</th><th>Date</th><th>Location</th><th>Status</th><th>Fee</th><th>Registrations</th><th>Actions</th></tr>
            </thead>
            <tbody>
                @forelse($events as $event)
                <tr>
                    <td class="px-4">
                        <div class="fw-semibold">{{ Str::limit($event->title, 45) }}</div>
                        @if($event->is_online)<small class="badge bg-info">Online</small>@endif
                    </td>
                    <td><small>{{ $event->start_date->format('M d, Y') }}</small></td>
                    <td><small class="text-muted">{{ Str::limit($event->location, 30) }}</small></td>
                    <td>
                        <span class="badge bg-{{ $event->status === 'upcoming' ? 'success' : ($event->status === 'past' ? 'secondary' : 'warning') }}">
                            {{ ucfirst($event->status) }}
                        </span>
                    </td>
                    <td>
                        @if($event->is_free)<span class="badge bg-success">Free</span>
                        @else<small>PKR {{ number_format($event->price) }}</small>@endif
                    </td>
                    <td>
                        <a href="{{ route('admin.events.registrations', $event) }}" class="badge bg-primary text-decoration-none">{{ $event->registrations_count }} reg.</a>
                    </td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('admin.events.edit', $event) }}" class="btn btn-sm btn-light"><i class="bi bi-pencil"></i></a>
                            <form method="POST" action="{{ route('admin.events.destroy', $event) }}" onsubmit="return confirm('Delete?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center py-5 text-muted">No events yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($events->hasPages())<div class="p-4">{{ $events->links() }}</div>@endif
</div>
@endsection
