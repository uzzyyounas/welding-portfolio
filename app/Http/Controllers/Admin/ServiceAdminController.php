<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ServiceAdminController extends Controller
{
    public function index()
    {
        $services = Service::withTrashed()->orderBy('sort_order')->paginate(15);
        return view('admin.services.index', compact('services'));
    }

    public function create() { return view('admin.services.create'); }

    public function store(Request $request)
    {
        $validated = $this->validateService($request);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('services', 'public');
        }

        $validated['features'] = $request->features ? array_filter(explode("\n", $request->features)) : null;
        $validated['deliverables'] = $request->deliverables ? array_filter(explode("\n", $request->deliverables)) : null;

        Service::create($validated);
        return redirect()->route('admin.services.index')->with('success', 'Service created!');
    }

    public function edit(Service $service) { return view('admin.services.edit', compact('service')); }

    public function update(Request $request, Service $service)
    {
        $validated = $this->validateService($request, $service->id);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('services', 'public');
        }

        $validated['features'] = $request->features ? array_filter(explode("\n", $request->features)) : null;
        $validated['deliverables'] = $request->deliverables ? array_filter(explode("\n", $request->deliverables)) : null;

        $service->update($validated);
        return redirect()->route('admin.services.index')->with('success', 'Service updated!');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Service deleted!');
    }

    private function validateService(Request $request, ?int $id = null): array
    {
        return $request->validate([
            'title'            => 'required|string|max:255',
            'icon'             => 'nullable|string|max:100',
            'excerpt'          => 'required|string|max:500',
            'description'      => 'required|string',
            'featured_image'   => 'nullable|image|max:2048',
            'features'         => 'nullable|string',
            'deliverables'     => 'nullable|string',
            'is_active'        => 'boolean',
            'sort_order'       => 'nullable|integer',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ]);
    }
}
