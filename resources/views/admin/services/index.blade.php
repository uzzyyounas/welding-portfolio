@extends('layouts.admin')
@section('title', 'Services')
@section('breadcrumb')<li class="breadcrumb-item active">Services</li>@endsection
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Services</h4>
    <a href="{{ route('admin.services.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-2"></i>Add Service</a>
</div>
<div class="card border-0 shadow-sm rounded-3">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr><th class="px-4">Service</th><th>Status</th><th>Order</th><th>Actions</th></tr>
            </thead>
            <tbody>
                @forelse($services as $service)
                <tr>
                    <td class="px-4">
                        <div class="d-flex align-items-center gap-3">
                            <div style="width:40px;height:40px;background:linear-gradient(135deg,#e94560,#c0392b);border-radius:10px;display:flex;align-items:center;justify-content:center;color:white;">
                                <i class="bi {{ $service->icon ?? 'bi-star' }}"></i>
                            </div>
                            <div>
                                <div class="fw-semibold">{{ $service->title }}</div>
                                <small class="text-muted">{{ Str::limit($service->excerpt, 60) }}</small>
                            </div>
                        </div>
                    </td>
                    <td><span class="badge {{ $service->is_active ? 'bg-success' : 'bg-secondary' }}">{{ $service->is_active ? 'Active' : 'Inactive' }}</span></td>
                    <td>{{ $service->sort_order }}</td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-sm btn-light"><i class="bi bi-pencil"></i></a>
                            <form method="POST" action="{{ route('admin.services.destroy', $service) }}" onsubmit="return confirm('Delete?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-center py-5 text-muted">No services.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
