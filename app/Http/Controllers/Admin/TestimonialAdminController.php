<?php

namespace App\Http\Controllers\Admin;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class TestimonialAdminController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::latest()->paginate(15);
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create() { return view('admin.testimonials.create'); }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'author_name'         => 'required|string|max:255',
            'author_title'        => 'nullable|string|max:255',
            'author_organization' => 'nullable|string|max:255',
            'author_image'        => 'nullable|image|max:1024',
            'content'             => 'required|string',
            'rating'              => 'required|integer|min:1|max:5',
            'video_url'           => 'nullable|url',
            'is_featured'         => 'boolean',
            'is_active'           => 'boolean',
            'sort_order'          => 'nullable|integer',
        ]);

        if ($request->hasFile('author_image')) {
            $validated['author_image'] = $request->file('author_image')->store('testimonials', 'public');
        }

        Testimonial::create($validated);
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial added!');
    }

    public function edit(Testimonial $testimonial) { return view('admin.testimonials.edit', compact('testimonial')); }

    public function update(Request $request, Testimonial $testimonial)
    {
        $validated = $request->validate([
            'author_name'         => 'required|string|max:255',
            'author_title'        => 'nullable|string|max:255',
            'author_organization' => 'nullable|string|max:255',
            'author_image'        => 'nullable|image|max:1024',
            'content'             => 'required|string',
            'rating'              => 'required|integer|min:1|max:5',
            'video_url'           => 'nullable|url',
            'is_featured'         => 'boolean',
            'is_active'           => 'boolean',
            'sort_order'          => 'nullable|integer',
        ]);

        if ($request->hasFile('author_image')) {
            $validated['author_image'] = $request->file('author_image')->store('testimonials', 'public');
        }

        $testimonial->update($validated);
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial updated!');
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial deleted!');
    }

    public function toggleActive(Testimonial $testimonial)
    {
        $testimonial->update(['is_active' => !$testimonial->is_active]);
        return back()->with('success', 'Status updated!');
    }
}
