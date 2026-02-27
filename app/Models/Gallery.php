<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gallery extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title', 'description', 'type', 'file_path', 'video_url',
        'thumbnail', 'category', 'is_active', 'sort_order',
    ];

    protected $casts = ['is_active' => 'boolean'];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }

    public function getUrlAttribute(): string
    {
        if ($this->type === 'video') {
            return $this->video_url;
        }
        return $this->file_path ? asset('storage/' . $this->file_path) : '';
    }

    public function getThumbnailUrlAttribute(): string
    {
        if ($this->thumbnail) return asset('storage/' . $this->thumbnail);
        if ($this->type === 'video' && $this->video_url) {
            // Extract YouTube ID
            preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^&\s]+)/', $this->video_url, $m);
            if (!empty($m[1])) {
                return "https://img.youtube.com/vi/{$m[1]}/mqdefault.jpg";
            }
        }
        return $this->file_path ? asset('storage/' . $this->file_path) : asset('images/default-gallery.jpg');
    }
}
