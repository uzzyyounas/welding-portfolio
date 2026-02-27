@extends('layouts.admin')
@section('title', 'Message from ' . $message->name)
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.messages.index') }}">Messages</a></li>
<li class="breadcrumb-item active">View</li>
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Message Details</h4>
    <a href="{{ route('admin.messages.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Back</a>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-3 p-4">
            <div class="d-flex align-items-center gap-3 mb-4">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($message->name) }}&background=e94560&color=fff&size=52" class="rounded-circle" width="52" height="52">
                <div>
                    <h5 class="mb-0">{{ $message->name }}</h5>
                    <small class="text-muted">{{ $message->email }} @if($message->phone) · {{ $message->phone }} @endif</small>
                </div>
                <span class="badge {{ $message->is_read ? 'bg-success' : 'bg-danger' }} ms-auto">{{ $message->is_read ? 'Read' : 'New' }}</span>
            </div>

            <div class="mb-3">
                <div class="text-muted small fw-semibold text-uppercase mb-1">Subject</div>
                <div class="fw-semibold">{{ $message->subject }}</div>
            </div>

            <div class="mb-3">
                <div class="text-muted small fw-semibold text-uppercase mb-1">Message</div>
                <div class="bg-light rounded-3 p-3" style="line-height:1.7;">{{ $message->message }}</div>
            </div>

            <div class="d-flex gap-2 mt-4">
                <a href="mailto:{{ $message->email }}?subject=Re: {{ $message->subject }}" class="btn btn-primary"><i class="bi bi-reply me-2"></i>Reply via Email</a>
                <form method="POST" action="{{ route('admin.messages.destroy', $message) }}" onsubmit="return confirm('Delete this message?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-outline-danger"><i class="bi bi-trash me-1"></i>Delete</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card border-0 shadow-sm rounded-3 p-4">
            <h6 class="fw-bold mb-3">Message Info</h6>
            <dl class="mb-0">
                <dt class="text-muted small">Received</dt>
                <dd class="mb-3">{{ $message->created_at->format('F d, Y \a\t H:i') }}</dd>
                @if($message->is_read)
                <dt class="text-muted small">Read At</dt>
                <dd class="mb-3">{{ $message->read_at?->format('F d, Y \a\t H:i') }}</dd>
                @endif
                @if($message->ip_address)
                <dt class="text-muted small">IP Address</dt>
                <dd class="mb-0 font-monospace small">{{ $message->ip_address }}</dd>
                @endif
            </dl>
        </div>
    </div>
</div>
@endsection
