@extends('layouts.admin')
@section('title', 'Contact Messages')
@section('breadcrumb')
<li class="breadcrumb-item active">Messages</li>
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Contact Messages</h4>
        <p class="text-muted small mb-0">{{ $messages->total() }} total messages</p>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-3">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th class="px-4">From</th>
                    <th>Subject</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($messages as $msg)
                <tr class="{{ !$msg->is_read ? 'fw-semibold table-light' : '' }}">
                    <td class="px-4">
                        <div>{{ $msg->name }}</div>
                        <small class="text-muted">{{ $msg->email }}</small>
                    </td>
                    <td>{{ Str::limit($msg->subject, 50) }}</td>
                    <td>
                        @if($msg->is_read)
                            <span class="badge bg-success">Read</span>
                        @else
                            <span class="badge bg-danger">New</span>
                        @endif
                    </td>
                    <td><small class="text-muted">{{ $msg->created_at->format('M d, Y H:i') }}</small></td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('admin.messages.show', $msg) }}" class="btn btn-sm btn-primary"><i class="bi bi-eye"></i></a>
                            <form method="POST" action="{{ route('admin.messages.destroy', $msg) }}" onsubmit="return confirm('Delete this message?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center text-muted py-5">No messages yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($messages->hasPages())
    <div class="card-footer bg-transparent px-4 py-3">{{ $messages->links() }}</div>
    @endif
</div>
@endsection
