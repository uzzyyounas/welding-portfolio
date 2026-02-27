<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Gallery;
use Illuminate\Routing\Controller;

class GalleryController extends Controller
{
    public function index()
    {
        $images = Gallery::active()->where('type', 'image')->get();
        $videos = Gallery::active()->where('type', 'video')->get();
        $categories = Gallery::active()->whereNotNull('category')->distinct()->pluck('category');
        return view('frontend.gallery.index', compact('images', 'videos', 'categories'));
    }
}
