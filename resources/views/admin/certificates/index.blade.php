{{-- resources/views/admin/certificates/index.blade.php --}}
@extends('layouts.admin')
@section('title', 'Certificates')
@section('breadcrumb')<li class="breadcrumb-item active">Certificates</li>@endsection
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Certifications</h4>
    <a href="{{ route('admin.certificates.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-2"></i>Add Certificate</a>
</div>
<div class="card border-0 shadow-sm rounded-3">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr><th class="px-4">Certificate</th><th>Organization</th><th>Year</th><th>Category</th><th>Actions</th></tr>
            </thead>
            <tbody>
                @forelse($certificates as $cert)
                <tr>
                    <td class="px-4">
                        <div class="d-flex align-items-center gap-3">
                            @if($cert->certificate_image)
                                <img src="{{ $cert->image_url }}" class="rounded" width="48" height="36" style="object-fit:cover;">
                            @else
                                <div style="width:48px;height:36px;background:#f0f2f5;border-radius:6px;display:flex;align-items:center;justify-content:center;">🏆</div>
                            @endif
                            <span class="fw-semibold small">{{ $cert->title }}</span>
                        </div>
                    </td>
                    <td><small class="text-muted">{{ $cert->issuing_organization }}</small></td>
                    <td><span class="badge bg-primary">{{ $cert->year }}</span></td>
                    <td><small>{{ $cert->category ?? '—' }}</small></td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('admin.certificates.edit', $cert) }}" class="btn btn-sm btn-light"><i class="bi bi-pencil"></i></a>
                            <form method="POST" action="{{ route('admin.certificates.destroy', $cert) }}" onsubmit="return confirm('Delete?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center py-5 text-muted">No certificates.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($certificates->hasPages())<div class="p-4">{{ $certificates->links() }}</div>@endif
</div>
@endsection
