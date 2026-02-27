{{-- resources/views/admin/testimonials/index.blade.php --}}
@extends('layouts.admin')
@section('title', 'Testimonials')
@section('breadcrumb')<li class="breadcrumb-item active">Testimonials</li>@endsection
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Testimonials</h4>
    <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-2"></i>Add Testimonial</a>
</div>
<div class="card border-0 shadow-sm rounded-3">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr><th class="px-4">Author</th><th>Rating</th><th>Featured</th><th>Status</th><th>Actions</th></tr>
            </thead>
            <tbody>
                @forelse($testimonials as $t)
                <tr>
                    <td class="px-4">
                        <div class="d-flex align-items-center gap-3">
                            @if($t->author_image)
                                <img src="{{ asset('storage/'.$t->author_image) }}" class="rounded-circle" width="36" height="36" style="object-fit:cover;">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($t->author_name) }}&size=36&background=e94560&color=fff" class="rounded-circle" width="36" height="36">
                            @endif
                            <div>
                                <div class="fw-semibold">{{ $t->author_name }}</div>
                                <small class="text-muted">{{ $t->author_organization }}</small>
                            </div>
                        </div>
                    </td>
                    <td><span style="color:#f59e0b;">{{ str_repeat('★', $t->rating) }}</span></td>
                    <td>@if($t->is_featured)<span class="badge bg-warning">Featured</span>@else<span class="text-muted small">—</span>@endif</td>
                    <td>
                        <form method="POST" action="{{ route('admin.testimonials.toggle', $t) }}" class="d-inline">
                            @csrf @method('PATCH')
                            <button class="btn btn-sm {{ $t->is_active ? 'btn-success' : 'btn-secondary' }}">{{ $t->is_active ? 'Active' : 'Inactive' }}</button>
                        </form>
                    </td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('admin.testimonials.edit', $t) }}" class="btn btn-sm btn-light"><i class="bi bi-pencil"></i></a>
                            <form method="POST" action="{{ route('admin.testimonials.destroy', $t) }}" onsubmit="return confirm('Delete?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center py-5 text-muted">No testimonials.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($testimonials->hasPages())<div class="p-4">{{ $testimonials->links() }}</div>@endif
</div>
@endsection
