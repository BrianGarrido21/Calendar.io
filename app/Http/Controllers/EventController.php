<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Models\Event;
use App\Models\Status;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $userId = Auth::id();
        $query = Event::with(['status', 'user'])
            ->where(function ($q) use ($userId) {
                $q->where('user_id', $userId)
                    ->orWhereHas('collaborations', fn($q) => $q->where('user_id', $userId));
            });

        // Filtros
        if ($request->filled('status')) {
            $query->where('status_id', $request->status);
        }

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('description', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('date')) {
            $query->whereDate('start_datetime', $request->date);
        }

        $events = $query->orderBy('start_datetime', 'desc')->paginate(5);

        $statuses = Status::all();

        return view('events.index', compact('events', 'statuses'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $statuses = Status::all();
        $tags = Tag::all();
        return view('events.create', compact('statuses', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['user_id'] = Auth::id();

        $event = Event::create($validatedData);

        if ($request->has('tags')) {
            $event->tags()->sync($request->input('tags'));
        }
        return redirect()->route('events.index')->with('success', 'Evento creado exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        $event->load(['status', 'user', 'tasks', 'collaborations', 'attachments', 'tags']);
        return view('events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        $statuses = Status::all();
        $tags = Tag::all();
        return view('events.edit', compact('event', 'statuses', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EventRequest $request, Event $event)
    {

        $event->update($request->except('tags'));

        if ($request->has('tags')) {
            $event->tags()->sync($request->input('tags'));
        }

        return redirect()->route('events.index')->with('success', '¡Evento actualizado correctamente!');
    }
}
