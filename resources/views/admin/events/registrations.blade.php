@extends('layouts.admin')
@section('title', 'Registrations - ' . $event->title)
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.events.index') }}">Events</a></li>
<li class="breadcrumb-item active">Registrations</li>
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Event Registrations</h4>
        <p class="text-muted small mb-0">{{ $event->title }}</p>
    </div>
    <a href="{{ route('admin.events.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Back</a>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="stat-card text-center">
            <div class="h4 fw-bold text-primary">{{ $registrations->total() }}</div>
            <div class="text-muted small">Total Registrations</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card text-center">
            <div class="h4 fw-bold text-success">{{ $registrations->where('status', 'confirmed')->count() }}</div>
            <div class="text-muted small">Confirmed</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card text-center">
            <div class="h4 fw-bold text-warning">{{ $registrations->where('status', 'pending')->count() }}</div>
            <div class="text-muted small">Pending</div>
        </div>
    </div>
    @if($event->max_participants)
    <div class="col-md-3">
        <div class="stat-card text-center">
            <div class="h4 fw-bold {{ ($event->max_participants - $registrations->total()) < 10 ? 'text-danger' : 'text-info' }}">{{ $event->max_participants - $registrations->total() }}</div>
            <div class="text-muted small">Spots Remaining</div>
        </div>
    </div>
    @endif
</div>

<div class="card border-0 shadow-sm rounded-3">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr><th class="px-4">Name</th><th>Email</th><th>Phone</th><th>Organization</th><th>Status</th><th>Date</th></tr>
            </thead>
            <tbody>
                @forelse($registrations as $reg)
                <tr>
                    <td class="px-4 fw-semibold">{{ $reg->name }}</td>
                    <td>{{ $reg->email }}</td>
                    <td><small class="text-muted">{{ $reg->phone ?? '—' }}</small></td>
                    <td><small class="text-muted">{{ $reg->organization ?? '—' }}</small></td>
                    <td>
                        <span class="badge bg-{{ $reg->status === 'confirmed' ? 'success' : ($reg->status === 'pending' ? 'warning' : 'secondary') }}">
                            {{ ucfirst($reg->status) }}
                        </span>
                    </td>
                    <td><small class="text-muted">{{ $reg->created_at->format('M d, Y') }}</small></td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center py-5 text-muted">No registrations yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($registrations->hasPages())<div class="p-4">{{ $registrations->links() }}</div>@endif
</div>
@endsection
