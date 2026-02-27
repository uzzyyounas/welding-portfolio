@extends('layouts.admin')
@section('title', isset($service) ? 'Edit Service' : 'Add Service')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.services.index') }}">Services</a></li>
<li class="breadcrumb-item active">{{ isset($service) ? 'Edit' : 'Add' }}</li>
@endsection
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">{{ isset($service) ? 'Edit' : 'Add' }} Service</h4>
    <a href="{{ route('admin.services.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Back</a>
</div>
<form method="POST" action="{{ isset($service) ? route('admin.services.update', $service) : route('admin.services.store') }}" enctype="multipart/form-data">
    @csrf
    @if(isset($service)) @method('PUT') @endif
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-3 p-4 mb-4">
                <div class="row g-3">
                    <div class="col-md-8">
                        <label class="form-label fw-semibold small">Service Title *</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title', $service->title ?? '') }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold small">Bootstrap Icon Class</label>
                        <input type="text" name="icon" class="form-control" value="{{ old('icon', $service->icon ?? '') }}" placeholder="bi-mortarboard">
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-semibold small">Excerpt (Card Summary) *</label>
                        <textarea name="excerpt" class="form-control" rows="2" required>{{ old('excerpt', $service->excerpt ?? '') }}</textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-semibold small">Full Description *</label>
                        <textarea name="description" class="form-control" rows="8" required>{{ old('description', $service->description ?? '') }}</textarea>
                    </div>
                </div>
            </div>
            <div class="card border-0 shadow-sm rounded-3 p-4 mb-4">
                <h6 class="fw-bold mb-3">Features & Deliverables</h6>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold small">Key Features (one per line)</label>
                        <textarea name="features" class="form-control" rows="6" placeholder="Feature 1&#10;Feature 2&#10;Feature 3">{{ old('features', isset($service) && $service->features ? implode("\n", $service->features) : '') }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold small">Deliverables (one per line)</label>
                        <textarea name="deliverables" class="form-control" rows="6" placeholder="Item 1&#10;Item 2&#10;Item 3">{{ old('deliverables', isset($service) && $service->deliverables ? implode("\n", $service->deliverables) : '') }}</textarea>
                    </div>
                </div>
            </div>
            <div class="card border-0 shadow-sm rounded-3 p-4">
                <h6 class="fw-bold mb-3">SEO</h6>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold small">Meta Title</label>
                        <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title', $service->meta_title ?? '') }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold small">Meta Description</label>
                        <input type="text" name="meta_description" class="form-control" value="{{ old('meta_description', $service->meta_description ?? '') }}">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-3 p-4 mb-4">
                <h6 class="fw-bold mb-3">Publish</h6>
                <div class="mb-3">
                    <label class="form-label fw-semibold small">Sort Order</label>
                    <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $service->sort_order ?? 0) }}">
                </div>
                <div class="form-check mb-3">
                    <input type="checkbox" name="is_active" value="1" class="form-check-input" {{ old('is_active', $service->is_active ?? true) ? 'checked' : '' }}>
                    <label class="form-check-label">Active (visible on site)</label>
                </div>
                <button type="submit" class="btn btn-primary w-100">{{ isset($service) ? 'Update' : 'Save' }} Service</button>
            </div>
            <div class="card border-0 shadow-sm rounded-3 p-4">
                <h6 class="fw-bold mb-3">Featured Image</h6>
                @if(isset($service) && $service->featured_image)
                    <img src="{{ $service->featured_image_url }}" class="img-fluid rounded mb-3 w-100" style="max-height:160px;object-fit:cover;">
                @endif
                <input type="file" name="featured_image" class="form-control" accept="image/*">
            </div>
        </div>
    </div>
</form>
@endsection
