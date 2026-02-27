@extends('layouts.admin')
@section('title', isset($event) ? 'Edit Event' : 'Create Event')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.events.index') }}">Events</a></li>
<li class="breadcrumb-item active">{{ isset($event) ? 'Edit' : 'Create' }}</li>
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">{{ isset($event) ? 'Edit Event' : 'Create New Event' }}</h4>
    <a href="{{ route('admin.events.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Back</a>
</div>

<form method="POST" action="{{ isset($event) ? route('admin.events.update', $event) : route('admin.events.store') }}" enctype="multipart/form-data">
    @csrf
    @if(isset($event)) @method('PUT') @endif

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-3 p-4 mb-4">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Event Title *</label>
                    <input type="text" name="title" class="form-control form-control-lg @error('title') is-invalid @enderror" value="{{ old('title', $event->title ?? '') }}" required>
                    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Excerpt</label>
                    <textarea name="excerpt" class="form-control" rows="2">{{ old('excerpt', $event->excerpt ?? '') }}</textarea>
                </div>
                <div>
                    <label class="form-label fw-semibold">Description *</label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="8">{{ old('description', $event->description ?? '') }}</textarea>
                    @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-3 p-4 mb-4">
                <h6 class="fw-bold mb-3">Date & Location</h6>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold small">Start Date *</label>
                        <input type="datetime-local" name="start_date" class="form-control @error('start_date') is-invalid @enderror" value="{{ old('start_date', isset($event) ? $event->start_date->format('Y-m-d\TH:i') : '') }}" required>
                        @error('start_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold small">End Date</label>
                        <input type="datetime-local" name="end_date" class="form-control" value="{{ old('end_date', isset($event) && $event->end_date ? $event->end_date->format('Y-m-d\TH:i') : '') }}">
                    </div>
                    <div class="col-md-12">
                        <div class="form-check mb-3">
                            <input type="checkbox" name="is_online" id="isOnline" value="1" class="form-check-input" {{ old('is_online', $event->is_online ?? false) ? 'checked' : '' }}>
                            <label class="form-check-label fw-semibold" for="isOnline">Online Event</label>
                        </div>
                    </div>
                    <div class="col-md-6" id="venueFields">
                        <label class="form-label fw-semibold small">Venue</label>
                        <input type="text" name="venue" class="form-control" value="{{ old('venue', $event->venue ?? '') }}" placeholder="Hotel / Conference Hall">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold small">City</label>
                        <input type="text" name="city" class="form-control" value="{{ old('city', $event->city ?? '') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold small">Country</label>
                        <input type="text" name="country" class="form-control" value="{{ old('country', $event->country ?? 'Pakistan') }}">
                    </div>
                    <div class="col-md-12" id="onlineLinkField" style="display:none;">
                        <label class="form-label fw-semibold small">Online Meeting Link</label>
                        <input type="url" name="online_link" class="form-control" value="{{ old('online_link', $event->online_link ?? '') }}" placeholder="https://zoom.us/j/...">
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-3 p-4">
                <h6 class="fw-bold mb-3">Pricing & Registration</h6>
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-check mb-2">
                            <input type="checkbox" name="is_free" id="isFree" value="1" class="form-check-input" {{ old('is_free', $event->is_free ?? true) ? 'checked' : '' }}>
                            <label class="form-check-label fw-semibold" for="isFree">Free Event</label>
                        </div>
                    </div>
                    <div class="col-md-6" id="priceField">
                        <label class="form-label fw-semibold small">Price (PKR)</label>
                        <input type="number" name="price" class="form-control" value="{{ old('price', $event->price ?? 0) }}" min="0">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold small">Max Participants</label>
                        <input type="number" name="max_participants" class="form-control" value="{{ old('max_participants', $event->max_participants ?? '') }}" placeholder="Leave blank for unlimited">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold small">Registration Deadline</label>
                        <input type="date" name="registration_deadline" class="form-control" value="{{ old('registration_deadline', $event->registration_deadline ?? '') }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold small">Status</label>
                        <select name="status" class="form-select">
                            @foreach(['upcoming', 'ongoing', 'past', 'cancelled'] as $s)
                            <option value="{{ $s }}" {{ old('status', $event->status ?? 'upcoming') == $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-3 p-4 mb-4">
                <h6 class="fw-bold mb-3">Featured Image</h6>
                @if(isset($event) && $event->featured_image)
                <img src="{{ $event->featured_image_url }}" class="img-fluid rounded mb-3 w-100" style="max-height:180px;object-fit:cover;">
                @endif
                <input type="file" name="featured_image" class="form-control" accept="image/*">
            </div>

            <div class="card border-0 shadow-sm rounded-3 p-4 mb-4">
                <h6 class="fw-bold mb-3">SEO</h6>
                <div class="mb-3">
                    <label class="form-label fw-semibold small">Meta Title</label>
                    <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title', $event->meta_title ?? '') }}">
                </div>
                <div>
                    <label class="form-label fw-semibold small">Meta Description</label>
                    <textarea name="meta_description" class="form-control" rows="3">{{ old('meta_description', $event->meta_description ?? '') }}</textarea>
                </div>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-lg"><i class="bi bi-save me-2"></i>{{ isset($event) ? 'Update' : 'Create' }} Event</button>
            </div>
        </div>
    </div>
</form>

@push('scripts')
<script>
    const isOnlineCheck = document.getElementById('isOnline');
    const isFreeCheck = document.getElementById('isFree');

    function toggleOnline() {
        const online = isOnlineCheck.checked;
        document.getElementById('venueFields').style.display = online ? 'none' : '';
        document.getElementById('onlineLinkField').style.display = online ? '' : 'none';
    }
    function toggleFree() {
        document.getElementById('priceField').style.display = isFreeCheck.checked ? 'none' : '';
    }

    isOnlineCheck.addEventListener('change', toggleOnline);
    isFreeCheck.addEventListener('change', toggleFree);
    toggleOnline();
    toggleFree();
</script>
@endpush
@endsection
