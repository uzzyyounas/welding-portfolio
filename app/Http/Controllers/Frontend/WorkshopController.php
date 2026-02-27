<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class WorkshopController extends Controller
{
    public function index()
    {
        $upcomingEvents = Event::upcoming()->orderBy('start_date')->paginate(6, ['*'], 'upcoming_page');
        $pastEvents = Event::past()->orderBy('start_date', 'desc')->paginate(6, ['*'], 'past_page');
        return view('frontend.workshops.index', compact('upcomingEvents', 'pastEvents'));
    }

    public function upcoming()
    {
        $events = Event::upcoming()->orderBy('start_date')->paginate(9);
        return view('frontend.workshops.upcoming', compact('events'));
    }

    public function past()
    {
        $events = Event::past()->orderBy('start_date', 'desc')->paginate(9);
        return view('frontend.workshops.past', compact('events'));
    }

    public function show(string $slug)
    {
        $event = Event::where('slug', $slug)->firstOrFail();
        $registrationCount = $event->registrations()->count();
        $spotsLeft = $event->max_participants ? $event->max_participants - $registrationCount : null;
        return view('frontend.workshops.show', compact('event', 'registrationCount', 'spotsLeft'));
    }

    public function register(Request $request, string $slug)
    {
        $event = Event::where('slug', $slug)->firstOrFail();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'organization' => 'nullable|string|max:255',
            'message' => 'nullable|string|max:1000',
        ]);

        // Check if already registered
        $exists = EventRegistration::where('event_id', $event->id)
            ->where('email', $validated['email'])->exists();

        if ($exists) {
            return back()->with('error', 'You have already registered for this event.');
        }

        EventRegistration::create(array_merge($validated, ['event_id' => $event->id]));

        return back()->with('success', 'Registration successful! We will contact you shortly.');
    }
}
