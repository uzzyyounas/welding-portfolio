@extends('layouts.frontend')
@section('title', 'Blog | Awais Iqbal Ch - Educational Insights & Teaching Tips')

@section('content')
<section class="page-header py-5 text-white" style="background:linear-gradient(135deg,#1a1a2e,#16213e,#0f3460);">
    <div class="container py-3">
        <nav aria-label="breadcrumb"><ol class="breadcrumb mb-2"><li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50">Home</a></li><li class="breadcrumb-item active text-white">Blog</li></ol></nav>
        <h1 class="display-5 fw-bold mb-2" style="font-family:'Playfair Display',serif;">Blog & Insights</h1>
        <p class="lead opacity-75">Educational articles, teaching strategies, and professional development tips.</p>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <!-- Search Bar -->
        <div class="row justify-content-center mb-5">
            <div class="col-md-8">
                <form method="GET" action="{{ route('blog.index') }}" class="d-flex">
                    <input type="search" name="search" class="form-control form-control-lg me-2 rounded-pill" placeholder="Search articles..." value="{{ request('search') }}">
                    <button class="btn btn-primary btn-lg px-4 rounded-pill">Search</button>
                </form>
            </div>
        </div>

        <div class="row g-5">
            <!-- Posts Column -->
            <div class="col-lg-8">
                @if($posts->isEmpty())
                    <div class="text-center py-5">
                        <i class="bi bi-journal-x text-muted" style="font-size:3rem;"></i>
                        <p class="text-muted mt-3">No posts found. Check back soon!</p>
                    </div>
                @else
                    <div class="row g-4">
                        @foreach($posts as $post)
                        <div class="col-md-6" data-aos="fade-up">
                            <div class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden blog-card-hover">
                                <img src="{{ $post->featured_image_url }}" alt="{{ $post->title }}" class="card-img-top" style="height:200px;object-fit:cover;" loading="lazy">
                                <div class="card-body">
                                    <div class="d-flex gap-2 mb-2">
                                        @if($post->category)
                                        <a href="{{ route('blog.category', $post->category->slug) }}" class="badge bg-primary text-decoration-none">{{ $post->category->name }}</a>
                                        @endif
                                    </div>
                                    <h6 class="card-title fw-bold">
                                        <a href="{{ route('blog.show', $post->slug) }}" class="text-dark text-decoration-none">{{ $post->title }}</a>
                                    </h6>
                                    <p class="text-muted small">{{ Str::limit($post->excerpt, 100) }}</p>
                                </div>
                                <div class="card-footer bg-transparent border-top d-flex justify-content-between align-items-center">
                                    <small class="text-muted">
                                        <i class="bi bi-calendar me-1"></i>{{ $post->published_at?->format('M d, Y') }}
                                        <span class="ms-2"><i class="bi bi-clock me-1"></i>{{ $post->read_time }}</span>
                                    </small>
                                    <small class="text-muted"><i class="bi bi-eye me-1"></i>{{ $post->views }}</small>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="mt-5">{{ $posts->links() }}</div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Categories -->
                <div class="card border-0 shadow-sm rounded-3 mb-4">
                    <div class="card-header bg-transparent fw-bold border-0 pt-3 px-4">Categories</div>
                    <div class="card-body px-4">
                        @foreach($categories as $cat)
                        <a href="{{ route('blog.category', $cat->slug) }}" class="d-flex justify-content-between align-items-center py-2 text-decoration-none text-dark border-bottom {{ request()->route('slug') == $cat->slug ? 'fw-bold text-primary' : '' }}">
                            <span>{{ $cat->name }}</span>
                            <span class="badge bg-light text-dark">{{ $cat->published_posts_count }}</span>
                        </a>
                        @endforeach
                    </div>
                </div>

                <!-- Recent Posts -->
                <div class="card border-0 shadow-sm rounded-3 mb-4">
                    <div class="card-header bg-transparent fw-bold border-0 pt-3 px-4">Recent Posts</div>
                    <div class="card-body px-4">
                        @foreach($recentPosts as $rp)
                        <div class="d-flex gap-3 mb-3 pb-3 border-bottom">
                            <img src="{{ $rp->featured_image_url }}" class="rounded" style="width:60px;height:50px;object-fit:cover;" alt="">
                            <div>
                                <a href="{{ route('blog.show', $rp->slug) }}" class="text-dark text-decoration-none small fw-semibold line-clamp-2">{{ $rp->title }}</a>
                                <div class="text-muted" style="font-size:.72rem;">{{ $rp->published_at?->format('M d, Y') }}</div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Tags -->
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-header bg-transparent fw-bold border-0 pt-3 px-4">Tags</div>
                    <div class="card-body px-4">
                        <div class="d-flex flex-wrap gap-2">
                            @foreach($tags as $tag)
                            <a href="{{ route('blog.tag', $tag->slug) }}" class="badge bg-light text-dark text-decoration-none border hover-primary">{{ $tag->name }} ({{ $tag->posts_count }})</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
