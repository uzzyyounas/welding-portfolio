<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\Event;
use App\Models\ContactMessage;
use App\Models\Testimonial;
use App\Models\NewsletterSubscriber;
use App\Models\EventRegistration;
use Illuminate\Routing\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_posts'         => Post::count(),
            'published_posts'     => Post::where('is_published', true)->count(),
            'total_events'        => Event::count(),
            'upcoming_events'     => Event::where('status', 'upcoming')->count(),
            'unread_messages'     => ContactMessage::where('is_read', false)->count(),
            'total_subscribers'   => NewsletterSubscriber::where('is_active', true)->count(),
            'total_testimonials'  => Testimonial::count(),
            'total_registrations' => EventRegistration::count(),
        ];

        $recentMessages = ContactMessage::latest()->take(5)->get();
        $recentPosts    = Post::with('category')->latest()->take(5)->get();
        $upcomingEvents = Event::where('status', 'upcoming')->orderBy('start_date')->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentMessages', 'recentPosts', 'upcomingEvents'));
    }
}
