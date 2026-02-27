@extends('layouts.admin')
@section('title', 'Blog Posts')
@section('breadcrumb')
<li class="breadcrumb-item active">Blog Posts</li>
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Blog Posts</h4>
        <p class="text-muted small mb-0">{{ $posts->total() }} total posts</p>
    </div>
    <a href="{{ route('admin.posts.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-2"></i>New Post</a>
</div>

<div class="card border-0 shadow-sm rounded-3">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th class="px-4">Title</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Views</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($posts as $post)
                <tr>
                    <td class="px-4">
                        <div class="fw-semibold">{{ Str::limit($post->title, 50) }}</div>
                        <small class="text-muted">/blog/{{ $post->slug }}</small>
                    </td>
                    <td>
                        @if($post->category)
                        <span class="badge bg-light text-dark">{{ $post->category->name }}</span>
                        @else <span class="text-muted small">—</span>
                        @endif
                    </td>
                    <td>
                        <span class="badge {{ $post->is_published ? 'bg-success' : 'bg-secondary' }}">
                            {{ $post->is_published ? 'Published' : 'Draft' }}
                        </span>
                    </td>
                    <td><small class="text-muted">{{ number_format($post->views) }}</small></td>
                    <td><small class="text-muted">{{ $post->created_at->format('M d, Y') }}</small></td>
                    <td>
                        <div class="d-flex gap-1">
                            <form method="POST" action="{{ route('admin.posts.toggle', $post) }}" class="d-inline">
                                @csrf @method('PATCH')
                                <button class="btn btn-sm {{ $post->is_published ? 'btn-warning' : 'btn-success' }}" title="{{ $post->is_published ? 'Unpublish' : 'Publish' }}">
                                    <i class="bi {{ $post->is_published ? 'bi-eye-slash' : 'bi-eye' }}"></i>
                                </button>
                            </form>
                            <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-sm btn-light"><i class="bi bi-pencil"></i></a>
                            <form method="POST" action="{{ route('admin.posts.destroy', $post) }}" onsubmit="return confirm('Delete this post?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center text-muted py-5">No posts yet. <a href="{{ route('admin.posts.create') }}">Create your first post</a></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($posts->hasPages())
    <div class="card-footer bg-transparent px-4 py-3">{{ $posts->links() }}</div>
    @endif
</div>
@endsection
