@extends('layouts.admin')
@section('title', isset($post) ? 'Edit Post' : 'Create Post')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.posts.index') }}">Posts</a></li>
<li class="breadcrumb-item active">{{ isset($post) ? 'Edit' : 'Create' }}</li>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css">
<style>
    .tagify { border: 1px solid #dee2e6; border-radius: .375rem; padding: .375rem .75rem; }
    .ql-toolbar { border-radius: .375rem .375rem 0 0; }
    .ql-container { border-radius: 0 0 .375rem .375rem; min-height: 300px; font-size: 1rem; }
</style>
@endpush

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">{{ isset($post) ? 'Edit Post' : 'Create New Post' }}</h4>
    <a href="{{ route('admin.posts.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Back</a>
</div>

<form method="POST" action="{{ isset($post) ? route('admin.posts.update', $post) : route('admin.posts.store') }}" enctype="multipart/form-data">
    @csrf
    @if(isset($post)) @method('PUT') @endif

    <div class="row g-4">
        <!-- Main Content -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-3 p-4 mb-4">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Post Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control form-control-lg @error('title') is-invalid @enderror" value="{{ old('title', $post->title ?? '') }}" placeholder="Enter post title..." required>
                    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Excerpt</label>
                    <textarea name="excerpt" class="form-control @error('excerpt') is-invalid @enderror" rows="3" placeholder="Brief summary of the post (optional)...">{{ old('excerpt', $post->excerpt ?? '') }}</textarea>
                    @error('excerpt')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div>
                    <label class="form-label fw-semibold">Content <span class="text-danger">*</span></label>
                    <div id="editor">{!! old('body', $post->body ?? '') !!}</div>
                    <input type="hidden" name="body" id="bodyInput">
                    @error('body')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>
            </div>

            <!-- SEO -->
            <div class="card border-0 shadow-sm rounded-3 p-4">
                <h6 class="fw-bold mb-3"><i class="bi bi-search me-2 text-primary"></i>SEO Settings</h6>
                <div class="mb-3">
                    <label class="form-label fw-semibold small">Meta Title</label>
                    <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title', $post->meta_title ?? '') }}" placeholder="SEO title (leave blank to use post title)">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold small">Meta Description</label>
                    <textarea name="meta_description" class="form-control" rows="2" placeholder="SEO description...">{{ old('meta_description', $post->meta_description ?? '') }}</textarea>
                </div>
                <div>
                    <label class="form-label fw-semibold small">Meta Keywords</label>
                    <input type="text" name="meta_keywords" class="form-control" value="{{ old('meta_keywords', $post->meta_keywords ?? '') }}" placeholder="keyword1, keyword2, keyword3">
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-3 p-4 mb-4">
                <h6 class="fw-bold mb-3">Publish</h6>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="is_published" id="isPublished" value="1" {{ old('is_published', $post->is_published ?? false) ? 'checked' : '' }}>
                    <label class="form-check-label fw-semibold" for="isPublished">Publish this post</label>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i>{{ isset($post) ? 'Update Post' : 'Create Post' }}</button>
                    @if(isset($post))
                    <a href="{{ route('blog.show', $post->slug) }}" target="_blank" class="btn btn-outline-secondary btn-sm"><i class="bi bi-eye me-1"></i>View Post</a>
                    @endif
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-3 p-4 mb-4">
                <h6 class="fw-bold mb-3">Category</h6>
                <select name="category_id" class="form-select">
                    <option value="">No Category</option>
                    @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ old('category_id', $post->category_id ?? '') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="card border-0 shadow-sm rounded-3 p-4 mb-4">
                <h6 class="fw-bold mb-3">Tags</h6>
                <input type="text" id="tagsInput" name="tags[]" value="{{ old('tags') ? implode(',', old('tags')) : (isset($post) ? $post->tags->pluck('name')->implode(',') : '') }}" placeholder="Add tags...">
            </div>

            <div class="card border-0 shadow-sm rounded-3 p-4">
                <h6 class="fw-bold mb-3">Featured Image</h6>
                @if(isset($post) && $post->featured_image)
                <img src="{{ $post->featured_image_url }}" class="img-fluid rounded mb-3" style="max-height:150px;width:100%;object-fit:cover;">
                @endif
                <input type="file" name="featured_image" class="form-control" accept="image/*" id="imageInput">
                <img id="imagePreview" class="img-fluid rounded mt-2 d-none" style="max-height:150px;object-fit:cover;">
            </div>
        </div>
    </div>
</form>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css">
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
<script>
    // Quill Editor
    const quill = new Quill('#editor', {
        theme: 'snow',
        modules: {
            toolbar: [
                ['bold','italic','underline','strike'],
                ['blockquote','code-block'],
                [{'header': [1,2,3,false]}],
                [{'list':'ordered'},{'list':'bullet'}],
                [{'color':[]},{'background':[]}],
                ['link','image'],
                ['clean']
            ]
        }
    });
    document.querySelector('form').addEventListener('submit', () => {
        document.getElementById('bodyInput').value = quill.root.innerHTML;
    });

    // Tagify
    new Tagify(document.getElementById('tagsInput'));

    // Image preview
    document.getElementById('imageInput').addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = e => {
                const preview = document.getElementById('imagePreview');
                preview.src = e.target.result;
                preview.classList.remove('d-none');
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush
@endsection
