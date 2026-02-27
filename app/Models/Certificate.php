<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'issuing_organization', 'year', 'certificate_image',
        'description', 'credential_url', 'category', 'is_active', 'sort_order',
    ];

    protected $casts = ['is_active' => 'boolean'];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('year', 'desc');
    }

    public function getImageUrlAttribute(): string
    {
        return $this->certificate_image
            ? asset('storage/' . $this->certificate_image)
            : asset('images/default-cert.jpg');
    }
}
