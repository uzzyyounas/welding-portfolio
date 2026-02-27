@extends('layouts.frontend')
@section('title', 'Tag: ' . $tag->name . ' | Blog')

@section('content')
<section class="page-header py-5 text-white" style="background:linear-gradient(135deg,#1a1a2e,#16213e,#0f3460);">
    <div class="container py-3">
        <nav aria-label="breadcrumb"><ol class="breadcrumb mb-2">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('blog.index') }}" class="text-white-50">Blog</a></li>
            <li class="breadcrumb-item active text-white">Tag: {{ $tag->name }}</li>
        </ol></nav>
        <div class="badge bg-warning text-dark mb-2">Tag</div>
        <h1 class="display-5 fw-bold mb-2" style="font-family:'Playfair Display',serif;">#{{ $tag->name }}</h1>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8">
                <p class="text-muted mb-4">{{ $posts->total() }} articles tagged with "{{ $tag->name }}"</p>
                @if($posts->isEmpty())
                    <p class="text-muted">No posts with this tag yet.</p>
                @else
                    <div class="row g-4">
                        @foreach($posts as $post)
                        <div class="col-md-6">
                            <div class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden blog-card-hover">
                                <img src="{{ $post->featured_image_url }}" class="card-img-top" style="height:190px;object-fit:cover;" alt="">
                                <div class="card-body">
                                    @if($post->category)<span class="badge bg-primary mb-2">{{ $post->category->name }}</span>@endif
                                    <h6><a href="{{ route('blog.show', $post->slug) }}" class="text-dark text-decoration-none">{{ $post->title }}</a></h6>
                                    <p class="text-muted small">{{ Str::limit($post->excerpt, 90) }}</p>
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
                    <div class="card-header bg-transparent fw-bold border-0 pt-3 px-4">Browse Tags</div>
                    <div class="card-body px-4">
                        <div class="d-flex flex-wrap gap-2">
                            @foreach($tags as $t)
                            <a href="{{ route('blog.tag', $t->slug) }}" class="badge text-decoration-none border {{ $t->id == $tag->id ? 'bg-primary' : 'bg-light text-dark' }}">{{ $t->name }} ({{ $t->posts_count }})</a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-header bg-transparent fw-bold border-0 pt-3 px-4">Categories</div>
                    <div class="card-body px-4">
                        @foreach($categories as $cat)
                        <a href="{{ route('blog.category', $cat->slug) }}" class="d-flex justify-content-between py-2 text-decoration-none text-dark border-bottom small">
                            <span>{{ $cat->name }}</span><span class="badge bg-light text-dark">{{ $cat->published_posts_count }}</span>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
