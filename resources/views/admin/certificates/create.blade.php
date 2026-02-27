@extends('layouts.admin')
@section('title', isset($certificate) ? 'Edit Certificate' : 'Add Certificate')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.certificates.index') }}">Certificates</a></li>
<li class="breadcrumb-item active">{{ isset($certificate) ? 'Edit' : 'Add' }}</li>
@endsection
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">{{ isset($certificate) ? 'Edit' : 'Add' }} Certificate</h4>
    <a href="{{ route('admin.certificates.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Back</a>
</div>
<div class="row"><div class="col-lg-7">
<div class="card border-0 shadow-sm rounded-3 p-4">
<form method="POST" action="{{ isset($certificate) ? route('admin.certificates.update', $certificate) : route('admin.certificates.store') }}" enctype="multipart/form-data">
    @csrf
    @if(isset($certificate)) @method('PUT') @endif
    <div class="row g-3">
        <div class="col-12">
            <label class="form-label fw-semibold small">Certificate Title *</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $certificate->title ?? '') }}" required>
        </div>
        <div class="col-md-8">
            <label class="form-label fw-semibold small">Issuing Organization *</label>
            <input type="text" name="issuing_organization" class="form-control" value="{{ old('issuing_organization', $certificate->issuing_organization ?? '') }}" required>
        </div>
        <div class="col-md-4">
            <label class="form-label fw-semibold small">Year *</label>
            <input type="number" name="year" class="form-control" value="{{ old('year', $certificate->year ?? date('Y')) }}" min="1990" max="{{ date('Y') }}" required>
        </div>
        <div class="col-md-6">
            <label class="form-label fw-semibold small">Category</label>
            <input type="text" name="category" class="form-control" value="{{ old('category', $certificate->category ?? '') }}" placeholder="e.g. Teaching, Digital Learning...">
        </div>
        <div class="col-md-6">
            <label class="form-label fw-semibold small">Credential URL</label>
            <input type="url" name="credential_url" class="form-control" value="{{ old('credential_url', $certificate->credential_url ?? '') }}">
        </div>
        <div class="col-12">
            <label class="form-label fw-semibold small">Description</label>
            <textarea name="description" class="form-control" rows="3">{{ old('description', $certificate->description ?? '') }}</textarea>
        </div>
        <div class="col-12">
            <label class="form-label fw-semibold small">Certificate Image</label>
            @if(isset($certificate) && $certificate->certificate_image)
                <img src="{{ $certificate->image_url }}" class="d-block rounded mb-2" style="max-height:120px;">
            @endif
            <input type="file" name="certificate_image" class="form-control" accept="image/*">
        </div>
        <div class="col-md-4">
            <label class="form-label fw-semibold small">Sort Order</label>
            <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $certificate->sort_order ?? 0) }}">
        </div>
        <div class="col-md-4 d-flex align-items-end">
            <div class="form-check mb-1">
                <input type="checkbox" name="is_active" value="1" class="form-check-input" {{ old('is_active', $certificate->is_active ?? true) ? 'checked' : '' }}>
                <label class="form-check-label">Active</label>
            </div>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary px-4">{{ isset($certificate) ? 'Update' : 'Save' }} Certificate</button>
        </div>
    </div>
</form>
</div>
</div></div>
@endsection
