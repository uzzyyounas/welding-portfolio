<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Service;
use Illuminate\Routing\Controller;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::active()->get();
        return view('frontend.services.index', compact('services'));
    }

    public function show(string $slug)
    {
        $service = Service::where('slug', $slug)->where('is_active', true)->firstOrFail();
        $otherServices = Service::active()->where('id', '!=', $service->id)->take(3)->get();
        return view('frontend.services.show', compact('service', 'otherServices'));
    }
}
