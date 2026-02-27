<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Certificate;
use Illuminate\Routing\Controller;

class CertificationController extends Controller
{
    public function index()
    {
        $certificates = Certificate::active()->get()->groupBy('category');
        $stats = [
            'total_certificates' => Certificate::active()->count(),
            'organizations' => Certificate::active()->distinct('issuing_organization')->count(),
            'years_active' => date('Y') - 2008,
        ];
        return view('frontend.certifications.index', compact('certificates', 'stats'));
    }
}
