<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventRequest;
use App\Models\Event;
use App\Models\Status;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{

    /**
     * Display a listing of the events.
     */
public function index()
{
    $userId = Auth::id();

    $events = Event::with(['user', 'status', 'tasks', 'collaborations', 'attachments', 'tags'])
        ->where('user_id', $userId)
        ->orWhereHas('collaborations', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })
        ->get()
        ->map(function ($event) {
            return [
                'title' => $event->description,
                'start' => $event->start_datetime,
                'end'   => $event->end_datetime,
                'extendedProps' => [
                    'id' => $event->id,
                    'user_name' => $event->user,
                    'location' => $event->location,
                    'status' => $event->status,
                    'tasks' => $event->tasks,
                    'collaborations' => $event->collaborations,
                    'attachments' => $event->attachments,
                    'tags' => $event->tags,
                ],
            ];
        });

    // 2️⃣ Obtener días festivos de Calendarific
    $apiKey = 'LjXvIBaLDI9AjLBqesOAHUoQuHtqVBiR';
    $country = 'ES';
    $year = date('Y');
    
    $url = "https://calendarific.com/api/v2/holidays?&api_key={$apiKey}&country={$country}&year={$year}";

    $response = Http::get($url);

    $holidays = $response->json()['response']['holidays'] ?? [];

    // 3️⃣ Mapear los días festivos como "eventos"
    $holidayEvents = collect($holidays)->map(function ($holiday) {
        return [
            'title' => $holiday['name'],
            'start' => $holiday['date']['iso'],
            'end'   => $holiday['date']['iso'], // Mismo día
            'extendedProps' => [
                'description' => $holiday['description'] ?? '',
                'type' => $holiday['type'] ?? [],
                'locations' => $holiday['locations'] ?? '',
            ],
        ];
    });

    $allEvents = $events->concat($holidayEvents)->values();

    return response()->json($allEvents);
}




    /**
     * Store a newly created event in storage.
     */
    public function store(EventRequest $request)
    {

        $event = Event::create($request->validated());
        return response()->json([
            'message' => 'Event created successfully',
            'data' => $event
        ], 201);
    }

    /**
     * Display the specified event.
     */
    public function show(Event $event)
    {
        return response()->json($event);
    }

    /**
     * Update the specified event in storage.
     */
    public function update(EventRequest $request, Event $event)
    {
        $event->update($request->validated());
        return response()->json([
            'message' => 'Event updated successfully',
            'data' => $event
        ]);
    }

    /**
     * Remove the specified event from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Event deleted successfully'
        ]);
    }

    /**
     * Attach a file to the event.
     */
    public function attachFile(Request $request, Event $event)
    {
        $file = $request->file('attachment');
        $path = $file->store('event-attachments', 'public');

        $attachment = $event->attachments()->create([
            'file_path' => $path,
            'file_name' => $file->getClientOriginalName(),
            'file_type' => $file->getClientMimeType(),
            'file_size' => $file->getSize()
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'File attached successfully',
            'data' => $attachment
        ]);
    }

    /**
     * Remove an attachment from the event.
     */
    public function removeAttachment(Event $event, $attachmentId)
    {
        $attachment = $event->attachments()->findOrFail($attachmentId);

        // Delete file from storage.
        Storage::disk('public')->delete($attachment->file_path);
        if (Storage::disk('public')->exists($attachment->file_path)) {
            Storage::disk('public')->delete($attachment->file_path);
        }
        // Delete record from database
        $attachment->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Attachment removed successfully'
        ]);
    }

    /**
     * Store a new collaboration for the event.
     */
    public function storeCollaboration(Request $request, Event $event)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role' => 'required|string|max:255',
        ]);

        $collaboration = $event->collaborations()->create([
            'user_id' => $request->user_id,
            'role' => $request->role
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Collaboration created successfully',
            'data' => $collaboration
        ], 201);
    }

    /**
     * Update the specified collaboration.
     */
    public function updateCollaboration(Request $request, Event $event, $collaborationId)
    {
        $collaboration = $event->collaborations()->findOrFail($collaborationId);

        $request->validate([
            'role' => 'required|string|max:255',
        ]);

        $collaboration->update([
            'role' => $request->role
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Collaboration updated successfully',
            'data' => $collaboration
        ]);
    }

    /**
     * Remove the specified collaboration.
     */
    public function destroyCollaboration(Event $event, $collaborationId)
    {
        $collaboration = $event->collaborations()->findOrFail($collaborationId);
        $collaboration->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Collaboration removed successfully'
        ]);
    }
}
