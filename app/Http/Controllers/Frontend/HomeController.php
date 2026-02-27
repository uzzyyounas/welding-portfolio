<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Post;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\Event;
use App\Models\Certificate;
use Illuminate\Routing\Controller;

class HomeController extends Controller
{
    public function index()
    {

        $latestPosts = Post::published()->latest()->with('category')->take(3)->get();
        $services = Service::active()->take(4)->get();
        $testimonials = Testimonial::featured()->take(6)->get();
        $upcomingEvents = Event::upcoming()->take(3)->get();

        $stats = [
            'years_experience' => 15,
            'students_trained' => 5000,
            'workshops_conducted' => 250,
            'certifications' => Certificate::active()->count() ?: 30,
        ];

        return view('frontend.home.index', compact(
            'latestPosts', 'services', 'testimonials', 'upcomingEvents', 'stats'
        ));
    }
}
