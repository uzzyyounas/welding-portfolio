@extends('layouts.admin')
@section('title', isset($gallery) ? 'Edit Gallery Item' : 'Add Gallery Item')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.gallery.index') }}">Gallery</a></li>
<li class="breadcrumb-item active">{{ isset($gallery) ? 'Edit' : 'Add' }}</li>
@endsection
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">{{ isset($gallery) ? 'Edit' : 'Add' }} Gallery Item</h4>
    <a href="{{ route('admin.gallery.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Back</a>
</div>
<div class="row"><div class="col-lg-7">
<div class="card border-0 shadow-sm rounded-3 p-4">
<form method="POST" action="{{ isset($gallery) ? route('admin.gallery.update', $gallery) : route('admin.gallery.store') }}" enctype="multipart/form-data">
    @csrf
    @if(isset($gallery)) @method('PUT') @endif
    <div class="row g-3">
        <div class="col-12">
            <label class="form-label fw-semibold small">Title *</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $gallery->title ?? '') }}" required>
        </div>
        <div class="col-md-6">
            <label class="form-label fw-semibold small">Type *</label>
            <select name="type" class="form-select" id="typeSelect">
                <option value="image" {{ old('type', $gallery->type ?? 'image') == 'image' ? 'selected' : '' }}>Image</option>
                <option value="video" {{ old('type', $gallery->type ?? '') == 'video' ? 'selected' : '' }}>Video</option>
            </select>
        </div>
        <div class="col-md-6">
            <label class="form-label fw-semibold small">Category</label>
            <input type="text" name="category" class="form-control" value="{{ old('category', $gallery->category ?? '') }}" placeholder="e.g. Workshops, Events...">
        </div>
        <div class="col-12" id="imageField">
            <label class="form-label fw-semibold small">Image File</label>
            @if(isset($gallery) && $gallery->file_path)
                <img src="{{ $gallery->url }}" class="d-block rounded mb-2" style="max-height:120px;">
            @endif
            <input type="file" name="file_path" class="form-control" accept="image/*">
        </div>
        <div class="col-12" id="videoField" style="display:none;">
            <label class="form-label fw-semibold small">YouTube / Video URL</label>
            <input type="url" name="video_url" class="form-control" value="{{ old('video_url', $gallery->video_url ?? '') }}" placeholder="https://youtube.com/watch?v=...">
        </div>
        <div class="col-12">
            <label class="form-label fw-semibold small">Description</label>
            <textarea name="description" class="form-control" rows="2">{{ old('description', $gallery->description ?? '') }}</textarea>
        </div>
        <div class="col-md-4">
            <label class="form-label fw-semibold small">Sort Order</label>
            <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $gallery->sort_order ?? 0) }}">
        </div>
        <div class="col-md-4 d-flex align-items-end">
            <div class="form-check mb-1">
                <input type="checkbox" name="is_active" value="1" class="form-check-input" {{ old('is_active', $gallery->is_active ?? true) ? 'checked' : '' }}>
                <label class="form-check-label">Active</label>
            </div>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary px-4">{{ isset($gallery) ? 'Update' : 'Save' }} Item</button>
        </div>
    </div>
</form>
</div>
</div></div>

@push('scripts')
<script>
    const typeSelect = document.getElementById('typeSelect');
    function toggleFields() {
        const isVideo = typeSelect.value === 'video';
        document.getElementById('imageField').style.display = isVideo ? 'none' : '';
        document.getElementById('videoField').style.display = isVideo ? '' : 'none';
    }
    typeSelect.addEventListener('change', toggleFields);
    toggleFields();
</script>
@endpush
@endsection
