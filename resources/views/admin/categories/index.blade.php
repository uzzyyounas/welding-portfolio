{{-- resources/views/admin/categories/index.blade.php --}}
@extends('layouts.admin')
@section('title', 'Categories')
@section('breadcrumb')<li class="breadcrumb-item active">Categories</li>@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Blog Categories</h4>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-2"></i>Add Category</a>
</div>

<div class="card border-0 shadow-sm rounded-3">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr><th class="px-4">Name</th><th>Slug</th><th>Posts</th><th>Actions</th></tr>
            </thead>
            <tbody>
                @forelse($categories as $cat)
                <tr>
                    <td class="px-4 fw-semibold">{{ $cat->name }}</td>
                    <td><code class="small">{{ $cat->slug }}</code></td>
                    <td><span class="badge bg-primary">{{ $cat->posts_count }}</span></td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('admin.categories.edit', $cat) }}" class="btn btn-sm btn-light"><i class="bi bi-pencil"></i></a>
                            <form method="POST" action="{{ route('admin.categories.destroy', $cat) }}" onsubmit="return confirm('Delete this category?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-center py-5 text-muted">No categories. <a href="{{ route('admin.categories.create') }}">Add one</a></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($categories->hasPages())<div class="p-4">{{ $categories->links() }}</div>@endif
</div>
@endsection
