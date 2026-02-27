<?php

namespace App\Http\Controllers\Admin;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::withCount('registrations')->latest()->paginate(15);
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateEvent($request);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('events', 'public');
        }

        Event::create($validated);
        return redirect()->route('admin.events.index')->with('success', 'Event created successfully!');
    }

    public function show(Event $event)
    {
        return view('admin.events.show', compact('event'));
    }

    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $this->validateEvent($request, $event->id);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('events', 'public');
        }

        $event->update($validated);
        return redirect()->route('admin.events.index')->with('success', 'Event updated successfully!');
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('admin.events.index')->with('success', 'Event deleted!');
    }

    public function registrations(Event $event)
    {
        $registrations = $event->registrations()->latest()->paginate(20);
        return view('admin.events.registrations', compact('event', 'registrations'));
    }

    private function validateEvent(Request $request, ?int $id = null): array
    {
        return $request->validate([
            'title'                  => 'required|string|max:255',
            'excerpt'                => 'nullable|string|max:500',
            'description'            => 'required|string',
            'featured_image'         => 'nullable|image|max:2048',
            'start_date'             => 'required|date',
            'end_date'               => 'nullable|date|after:start_date',
            'venue'                  => 'nullable|string|max:255',
            'city'                   => 'nullable|string|max:100',
            'country'                => 'nullable|string|max:100',
            'is_online'              => 'boolean',
            'online_link'            => 'nullable|url',
            'price'                  => 'nullable|numeric|min:0',
            'is_free'                => 'boolean',
            'max_participants'       => 'nullable|integer|min:1',
            'status'                 => 'required|in:upcoming,ongoing,past,cancelled',
            'registration_deadline'  => 'nullable|date',
            'meta_title'             => 'nullable|string|max:255',
            'meta_description'       => 'nullable|string|max:500',
        ]);
    }
}
