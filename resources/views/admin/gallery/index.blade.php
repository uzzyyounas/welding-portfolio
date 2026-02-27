@extends('layouts.admin')
@section('title', 'Gallery')
@section('breadcrumb')<li class="breadcrumb-item active">Gallery</li>@endsection
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Media Gallery</h4>
    <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-2"></i>Add Media</a>
</div>
<div class="row g-4">
    @forelse($items as $item)
    <div class="col-md-4 col-lg-3">
        <div class="card border-0 shadow-sm rounded-3 overflow-hidden h-100">
            @if($item->type === 'video')
                <div style="height:140px;background:#1a1a2e;display:flex;align-items:center;justify-content:center;">
                    <i class="bi bi-play-circle text-white" style="font-size:2.5rem;"></i>
                </div>
            @elseif($item->file_path)
                <img src="{{ $item->thumbnail_url }}" style="height:140px;width:100%;object-fit:cover;" alt="{{ $item->title }}">
            @else
                <div style="height:140px;background:#f0f2f5;display:flex;align-items:center;justify-content:center;">
                    <i class="bi bi-image text-muted" style="font-size:2rem;"></i>
                </div>
            @endif
            <div class="card-body p-3">
                <div class="fw-semibold small mb-1">{{ Str::limit($item->title, 40) }}</div>
                <div class="d-flex gap-1 mb-2">
                    <span class="badge bg-{{ $item->type === 'video' ? 'danger' : 'info' }}">{{ ucfirst($item->type) }}</span>
                    @if($item->category)<span class="badge bg-light text-dark" style="font-size:.65rem;">{{ $item->category }}</span>@endif
                </div>
                <div class="d-flex gap-1">
                    <a href="{{ route('admin.gallery.edit', $item) }}" class="btn btn-sm btn-light flex-grow-1"><i class="bi bi-pencil"></i></a>
                    <form method="POST" action="{{ route('admin.gallery.destroy', $item) }}" onsubmit="return confirm('Delete?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12 text-center py-5 text-muted">No gallery items yet.</div>
    @endforelse
</div>
@if($items->hasPages())<div class="mt-4">{{ $items->links() }}</div>@endif
@endsection
