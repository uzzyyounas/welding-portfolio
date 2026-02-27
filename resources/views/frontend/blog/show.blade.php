@extends('layouts.frontend')
@section('title', $post->meta_title ?? $post->title)
@section('meta_description', $post->meta_description ?? $post->excerpt)
@section('meta_keywords', $post->meta_keywords)

@section('content')
<article>
    <!-- Post Header -->
    <section class="py-5 text-white" style="background:linear-gradient(135deg,#1a1a2e,#16213e,#0f3460);">
        <div class="container py-3">
            <nav aria-label="breadcrumb"><ol class="breadcrumb mb-3">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('blog.index') }}" class="text-white-50">Blog</a></li>
                <li class="breadcrumb-item active text-white">{{ Str::limit($post->title, 40) }}</li>
            </ol></nav>
            @if($post->category)
            <a href="{{ route('blog.category', $post->category->slug) }}" class="badge bg-primary text-decoration-none mb-2">{{ $post->category->name }}</a>
            @endif
            <h1 class="display-6 fw-bold mb-3" style="font-family:'Playfair Display',serif;max-width:750px;">{{ $post->title }}</h1>
            <div class="d-flex flex-wrap gap-3 align-items-center opacity-75 small">
                <span><i class="bi bi-calendar me-1"></i>{{ $post->published_at?->format('F d, Y') }}</span>
                <span><i class="bi bi-clock me-1"></i>{{ $post->read_time }}</span>
                <span><i class="bi bi-eye me-1"></i>{{ $post->views }} views</span>
            </div>
        </div>
    </section>

    <!-- Featured Image -->
    @if($post->featured_image)
    <div style="height:400px;overflow:hidden;">
        <img src="{{ $post->featured_image_url }}" alt="{{ $post->title }}" class="w-100 h-100" style="object-fit:cover;">
    </div>
    @endif

    <section class="py-5">
        <div class="container">
            <div class="row g-5">
                <!-- Post Content -->
                <div class="col-lg-8">
                    <div class="prose" style="font-size:1.05rem;line-height:1.8;">
                        {!! $post->body !!}
                    </div>

                    <!-- Tags -->
                    @if($post->tags->count())
                    <div class="mt-4 pt-4 border-top">
                        <strong class="me-2">Tags:</strong>
                        @foreach($post->tags as $tag)
                        <a href="{{ route('blog.tag', $tag->slug) }}" class="badge bg-light text-dark text-decoration-none border me-1">{{ $tag->name }}</a>
                        @endforeach
                    </div>
                    @endif

                    <!-- Share -->
                    <div class="mt-4 pt-4 border-top">
                        <strong class="me-3">Share:</strong>
                        <a href="https://facebook.com/sharer?u={{ urlencode(url()->current()) }}" target="_blank" class="btn btn-sm btn-outline-secondary me-1"><i class="bi bi-facebook"></i></a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($post->title) }}" target="_blank" class="btn btn-sm btn-outline-secondary me-1"><i class="bi bi-twitter-x"></i></a>
                        <a href="https://linkedin.com/shareArticle?url={{ urlencode(url()->current()) }}" target="_blank" class="btn btn-sm btn-outline-secondary"><i class="bi bi-linkedin"></i></a>
                    </div>

                    <!-- Comments -->
                    <div class="mt-5">
                        <h4 class="mb-4">{{ $post->approvedComments->count() }} Comments</h4>

                        @forelse($post->approvedComments as $comment)
                        <div class="d-flex gap-3 mb-4 pb-4 border-bottom">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($comment->author_name) }}&size=44&background=e94560&color=fff" class="rounded-circle" width="44" height="44">
                            <div>
                                <div class="fw-semibold">{{ $comment->author_name }} <small class="text-muted fw-normal">{{ $comment->created_at->diffForHumans() }}</small></div>
                                <p class="mb-0 text-muted">{{ $comment->body }}</p>
                            </div>
                        </div>
                        @empty
                        <p class="text-muted">No comments yet. Be the first to comment!</p>
                        @endforelse

                        <!-- Comment Form -->
                        <div class="card border-0 bg-light rounded-3 p-4 mt-4">
                            <h5 class="mb-4">Leave a Comment</h5>
                            @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
                            <form method="POST" action="{{ route('blog.comment', $post->slug) }}">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <input type="text" name="author_name" class="form-control @error('author_name') is-invalid @enderror" placeholder="Your Name *" value="{{ old('author_name') }}" required>
                                        @error('author_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-md-6">
                                        <input type="email" name="author_email" class="form-control @error('author_email') is-invalid @enderror" placeholder="Your Email *" value="{{ old('author_email') }}" required>
                                        @error('author_email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-12">
                                        <textarea name="body" class="form-control @error('body') is-invalid @enderror" rows="4" placeholder="Your comment..." required>{{ old('body') }}</textarea>
                                        @error('body')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary px-4">Post Comment</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <!-- Author Card -->
                    <div class="card border-0 shadow-sm rounded-3 mb-4 overflow-hidden">
                        <div class="text-center p-4">
                            <img src="{{ asset('images/about-full.jpg') }}" alt="Dr. Sarah" class="rounded-circle mb-3" width="80" height="80" style="object-fit:cover;">
                            <h6 class="fw-bold mb-1">Awais Iqbal Ch</h6>
                            <small class="text-muted">Educationist & Motivational Speaker</small>
                            <hr>
                            <p class="text-muted small">PhD holder with 15+ years transforming education through innovative teaching methodologies.</p>
                            <a href="{{ route('about') }}" class="btn btn-outline-primary btn-sm w-100">Learn More</a>
                        </div>
                    </div>

                    <!-- Recent Posts -->
                    <div class="card border-0 shadow-sm rounded-3 mb-4">
                        <div class="card-header bg-transparent fw-bold border-0 pt-3 px-4">Recent Articles</div>
                        <div class="card-body px-4">
                            @foreach($recentPosts as $rp)
                            <div class="d-flex gap-3 mb-3 pb-3 border-bottom">
                                <img src="{{ $rp->featured_image_url }}" class="rounded" style="width:56px;height:46px;object-fit:cover;" alt="">
                                <div><a href="{{ route('blog.show', $rp->slug) }}" class="text-dark text-decoration-none small fw-semibold">{{ Str::limit($rp->title, 55) }}</a></div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Categories -->
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

    <!-- Related Posts -->
    @if($relatedPosts->count())
    <section class="py-5 bg-light">
        <div class="container">
            <h4 class="mb-4">Related Articles</h4>
            <div class="row g-4">
                @foreach($relatedPosts as $rp)
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden">
                        <img src="{{ $rp->featured_image_url }}" class="card-img-top" style="height:180px;object-fit:cover;" alt="{{ $rp->title }}">
                        <div class="card-body">
                            <h6 class="card-title"><a href="{{ route('blog.show', $rp->slug) }}" class="text-dark text-decoration-none">{{ $rp->title }}</a></h6>
                            <p class="text-muted small">{{ Str::limit($rp->excerpt, 80) }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif
</article>
@endsection
