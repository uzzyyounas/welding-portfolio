@extends('layouts.admin')
@section('title', isset($testimonial) ? 'Edit Testimonial' : 'Add Testimonial')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.testimonials.index') }}">Testimonials</a></li>
<li class="breadcrumb-item active">{{ isset($testimonial) ? 'Edit' : 'Add' }}</li>
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">{{ isset($testimonial) ? 'Edit' : 'Add' }} Testimonial</h4>
    <a href="{{ route('admin.testimonials.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Back</a>
</div>

<div class="row">
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm rounded-3 p-4">
            <form method="POST" action="{{ isset($testimonial) ? route('admin.testimonials.update', $testimonial) : route('admin.testimonials.store') }}" enctype="multipart/form-data">
                @csrf
                @if(isset($testimonial)) @method('PUT') @endif

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold small">Author Name *</label>
                        <input type="text" name="author_name" class="form-control" value="{{ old('author_name', $testimonial->author_name ?? '') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold small">Title / Position</label>
                        <input type="text" name="author_title" class="form-control" value="{{ old('author_title', $testimonial->author_title ?? '') }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold small">Organization</label>
                        <input type="text" name="author_organization" class="form-control" value="{{ old('author_organization', $testimonial->author_organization ?? '') }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold small">Rating (1–5)</label>
                        <select name="rating" class="form-select">
                            @for($i = 5; $i >= 1; $i--)
                            <option value="{{ $i }}" {{ old('rating', $testimonial->rating ?? 5) == $i ? 'selected' : '' }}>{{ $i }} Stars {{ str_repeat('★', $i) }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-semibold small">Testimonial Content *</label>
                        <textarea name="content" class="form-control" rows="5" required>{{ old('content', $testimonial->content ?? '') }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold small">Video URL (optional)</label>
                        <input type="url" name="video_url" class="form-control" value="{{ old('video_url', $testimonial->video_url ?? '') }}" placeholder="https://youtube.com/...">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold small">Author Photo</label>
                        @if(isset($testimonial) && $testimonial->author_image)
                        <img src="{{ asset('storage/'.$testimonial->author_image) }}" class="rounded-circle d-block mb-2" width="48" height="48" style="object-fit:cover;">
                        @endif
                        <input type="file" name="author_image" class="form-control" accept="image/*">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold small">Sort Order</label>
                        <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $testimonial->sort_order ?? 0) }}">
                    </div>
                    <div class="col-md-4">
                        <div class="form-check mt-4">
                            <input type="checkbox" name="is_featured" value="1" class="form-check-input" id="isFeatured" {{ old('is_featured', $testimonial->is_featured ?? false) ? 'checked' : '' }}>
                            <label class="form-check-label" for="isFeatured">Featured</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-check mt-4">
                            <input type="checkbox" name="is_active" value="1" class="form-check-input" id="isActive" {{ old('is_active', $testimonial->is_active ?? true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="isActive">Active</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary px-4">{{ isset($testimonial) ? 'Update' : 'Save' }} Testimonial</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
