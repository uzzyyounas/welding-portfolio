@extends('layouts.admin')
@section('title', 'Newsletter Subscribers')
@section('breadcrumb')<li class="breadcrumb-item active">Newsletter</li>@endsection
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Newsletter Subscribers</h4>
        <p class="text-muted small mb-0">{{ $subscribers->total() }} total subscribers</p>
    </div>
</div>
<div class="card border-0 shadow-sm rounded-3">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr><th class="px-4">Email</th><th>Name</th><th>Status</th><th>Subscribed</th></tr>
            </thead>
            <tbody>
                @forelse($subscribers as $sub)
                <tr>
                    <td class="px-4 fw-semibold">{{ $sub->email }}</td>
                    <td>{{ $sub->name ?? '—' }}</td>
                    <td><span class="badge {{ $sub->is_active ? 'bg-success' : 'bg-secondary' }}">{{ $sub->is_active ? 'Active' : 'Unsubscribed' }}</span></td>
                    <td><small class="text-muted">{{ $sub->created_at->format('M d, Y') }}</small></td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-center py-5 text-muted">No subscribers yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($subscribers->hasPages())<div class="p-4">{{ $subscribers->links() }}</div>@endif
</div>
@endsection
