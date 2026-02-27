{{-- resources/views/frontend/blog/category.blade.php --}}
@extends('layouts.frontend')
@section('title', 'Category: ' . $category->name . ' | Blog')

@section('content')
<section class="page-header py-5 text-white" style="background:linear-gradient(135deg,#1a1a2e,#16213e,#0f3460);">
    <div class="container py-3">
        <nav aria-label="breadcrumb"><ol class="breadcrumb mb-2">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('blog.index') }}" class="text-white-50">Blog</a></li>
            <li class="breadcrumb-item active text-white">{{ $category->name }}</li>
        </ol></nav>
        <div class="badge bg-primary mb-2">Category</div>
        <h1 class="display-5 fw-bold mb-2" style="font-family:'Playfair Display',serif;">{{ $category->name }}</h1>
        @if($category->description)<p class="lead opacity-75">{{ $category->description }}</p>@endif
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8">
                <p class="text-muted mb-4">{{ $posts->total() }} articles in this category</p>
                @if($posts->isEmpty())
                    <p class="text-muted">No posts in this category yet.</p>
                @else
                    <div class="row g-4">
                        @foreach($posts as $post)
                        <div class="col-md-6">
                            <div class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden blog-card-hover">
                                <img src="{{ $post->featured_image_url }}" class="card-img-top" style="height:190px;object-fit:cover;" alt="{{ $post->title }}">
                                <div class="card-body">
                                    <h6><a href="{{ route('blog.show', $post->slug) }}" class="text-dark text-decoration-none">{{ $post->title }}</a></h6>
                                    <p class="text-muted small">{{ Str::limit($post->excerpt, 100) }}</p>
                                </div>
                                <div class="card-footer bg-transparent d-flex justify-content-between">
                                    <small class="text-muted">{{ $post->published_at?->format('M d, Y') }}</small>
                                    <a href="{{ route('blog.show', $post->slug) }}" class="text-primary small">Read →</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="mt-4">{{ $posts->links() }}</div>
                @endif
            </div>
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-3 mb-4">
                    <div class="card-header bg-transparent fw-bold border-0 pt-3 px-4">Categories</div>
                    <div class="card-body px-4">
                        @foreach($categories as $cat)
                        <a href="{{ route('blog.category', $cat->slug) }}" class="d-flex justify-content-between py-2 text-decoration-none border-bottom small {{ $cat->id == $category->id ? 'text-primary fw-bold' : 'text-dark' }}">
                            <span>{{ $cat->name }}</span><span class="badge bg-light text-dark">{{ $cat->published_posts_count }}</span>
                        </a>
                        @endforeach
                    </div>
                </div>
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-header bg-transparent fw-bold border-0 pt-3 px-4">Tags</div>
                    <div class="card-body px-4">
                        <div class="d-flex flex-wrap gap-2">
                            @foreach($tags as $tag)
                            <a href="{{ route('blog.tag', $tag->slug) }}" class="badge bg-light text-dark text-decoration-none border">{{ $tag->name }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
