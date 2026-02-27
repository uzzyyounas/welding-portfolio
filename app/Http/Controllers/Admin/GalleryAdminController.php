<?php

namespace App\Http\Controllers\Admin;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class GalleryAdminController extends Controller
{
    public function index()
    {
        $items = Gallery::withTrashed()->latest()->paginate(20);
        return view('admin.gallery.index', compact('items'));
    }

    public function create() { return view('admin.gallery.create'); }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'type'        => 'required|in:image,video',
            'file_path'   => 'required_if:type,image|nullable|image|max:4096',
            'video_url'   => 'required_if:type,video|nullable|url',
            'thumbnail'   => 'nullable|image|max:1024',
            'category'    => 'nullable|string|max:100',
            'is_active'   => 'boolean',
            'sort_order'  => 'nullable|integer',
        ]);

        if ($request->hasFile('file_path')) {
            $validated['file_path'] = $request->file('file_path')->store('gallery', 'public');
        }
        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('gallery/thumbnails', 'public');
        }

        Gallery::create($validated);
        return redirect()->route('admin.gallery.index')->with('success', 'Gallery item added!');
    }

    public function edit(Gallery $gallery) { return view('admin.gallery.edit', compact('gallery')); }

    public function update(Request $request, Gallery $gallery)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'type'        => 'required|in:image,video',
            'file_path'   => 'nullable|image|max:4096',
            'video_url'   => 'nullable|url',
            'thumbnail'   => 'nullable|image|max:1024',
            'category'    => 'nullable|string|max:100',
            'is_active'   => 'boolean',
            'sort_order'  => 'nullable|integer',
        ]);

        if ($request->hasFile('file_path')) {
            $validated['file_path'] = $request->file('file_path')->store('gallery', 'public');
        }
        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('gallery/thumbnails', 'public');
        }

        $gallery->update($validated);
        return redirect()->route('admin.gallery.index')->with('success', 'Gallery item updated!');
    }

    public function destroy(Gallery $gallery)
    {
        $gallery->delete();
        return redirect()->route('admin.gallery.index')->with('success', 'Item deleted!');
    }
}
