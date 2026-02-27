<?php

namespace App\Http\Controllers\Admin;

use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CertificateController extends Controller
{
    public function index()
    {
        $certificates = Certificate::orderByDesc('year')->paginate(15);
        return view('admin.certificates.index', compact('certificates'));
    }

    public function create() { return view('admin.certificates.create'); }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'                  => 'required|string|max:255',
            'issuing_organization'   => 'required|string|max:255',
            'year'                   => 'required|integer|min:1990|max:'.date('Y'),
            'certificate_image'      => 'nullable|image|max:2048',
            'description'            => 'nullable|string',
            'credential_url'         => 'nullable|url',
            'category'               => 'nullable|string|max:100',
            'is_active'              => 'boolean',
            'sort_order'             => 'nullable|integer',
        ]);

        if ($request->hasFile('certificate_image')) {
            $validated['certificate_image'] = $request->file('certificate_image')->store('certificates', 'public');
        }

        Certificate::create($validated);
        return redirect()->route('admin.certificates.index')->with('success', 'Certificate added!');
    }

    public function edit(Certificate $certificate) { return view('admin.certificates.edit', compact('certificate')); }

    public function update(Request $request, Certificate $certificate)
    {
        $validated = $request->validate([
            'title'                 => 'required|string|max:255',
            'issuing_organization'  => 'required|string|max:255',
            'year'                  => 'required|integer|min:1990|max:'.date('Y'),
            'certificate_image'     => 'nullable|image|max:2048',
            'description'           => 'nullable|string',
            'credential_url'        => 'nullable|url',
            'category'              => 'nullable|string|max:100',
            'is_active'             => 'boolean',
            'sort_order'            => 'nullable|integer',
        ]);

        if ($request->hasFile('certificate_image')) {
            $validated['certificate_image'] = $request->file('certificate_image')->store('certificates', 'public');
        }

        $certificate->update($validated);
        return redirect()->route('admin.certificates.index')->with('success', 'Certificate updated!');
    }

    public function destroy(Certificate $certificate)
    {
        $certificate->delete();
        return redirect()->route('admin.certificates.index')->with('success', 'Certificate deleted!');
    }
}
