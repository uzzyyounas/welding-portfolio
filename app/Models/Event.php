<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title', 'slug', 'excerpt', 'description', 'featured_image',
        'start_date', 'end_date', 'venue', 'city', 'country',
        'is_online', 'online_link', 'price', 'is_free', 'max_participants',
        'status', 'registration_deadline', 'meta_title', 'meta_description',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'is_online' => 'boolean',
        'is_free' => 'boolean',
        'price' => 'decimal:2',
    ];

    protected static function boot(): void
    {
        parent::boot();
        static::creating(fn($m) => $m->slug = $m->slug ?? Post::generateUniqueSlug($m->title));
    }

    public function scopeUpcoming($query)
    {
        return $query->where('status', 'upcoming')->where('start_date', '>=', now());
    }

    public function scopePast($query)
    {
        return $query->where('status', 'past')->orWhere('start_date', '<', now());
    }

    public function registrations(): HasMany
    {
        return $this->hasMany(EventRegistration::class);
    }

    public function getFeaturedImageUrlAttribute(): string
    {
        return $this->featured_image
            ? asset('storage/' . $this->featured_image)
            : asset('images/default-event.jpg');
    }

    public function getLocationAttribute(): string
    {
        if ($this->is_online) return 'Online';
        return collect([$this->venue, $this->city, $this->country])->filter()->implode(', ');
    }
}
