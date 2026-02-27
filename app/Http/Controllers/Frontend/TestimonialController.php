<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Testimonial;
use Illuminate\Routing\Controller;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::active()->paginate(12);
        return view('frontend.testimonials.index', compact('testimonials'));
    }
}
