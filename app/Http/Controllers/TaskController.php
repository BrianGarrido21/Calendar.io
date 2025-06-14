<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Event;
use App\Models\Status;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $userId = Auth::id();

        $eventIds = Event::where('user_id', $userId)
            ->orWhereHas('collaborations', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->pluck('id');

        $query = Task::with(['event', 'status'])
            ->whereIn('event_id', $eventIds);

        // Filtros
        if ($request->filled('status')) {
            $query->where('status_id', $request->status);
        }

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('due_date')) {
            $query->whereDate('due_date', $request->due_date);
        }

        $tasks = $query->orderBy('due_date', 'asc')->paginate(5);
        $statuses = \App\Models\Status::all();

        return view('tasks.index', compact('tasks', 'statuses'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();

        // Obtén solo los eventos donde el usuario es el owner
        $events = $user->events()->get();

        $statuses = Status::all(); // O como manejes los estados

        return view('tasks.create', compact('events', 'statuses'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskRequest $request)
    {

        $validated = $request->validated();

        $event = Event::where('id', $validated['event_id'])
            ->where('user_id', auth()->id())
            ->first();

        if (!$event) {
            return back()->withErrors(['event_id' => 'No puedes crear una tarea para este evento.']);
        }


        Task::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'due_date' => $validated['due_date'],
            'event_id' => $validated['event_id'],
            'status_id' => $validated['status_id'],
        ]);

        return redirect()->route('tasks.index')->with('success', '¡Tarea creada exitosamente!');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {

        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        // Obtener los eventos y los estados disponibles
        $events = Event::all();
        $statuses = Status::all();

        // Retornar la vista con la tarea, eventos y estados
        return view('tasks.edit', compact('task', 'events', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(TaskRequest $request, Task $task)
    {
        $validated = $request->validated();


        $event = Event::where('id', $validated['event_id'])
            ->where('user_id', auth()->id())
            ->first();

        if (!$event) {
            return back()->withErrors(['event_id' => 'No puedes actualizar esta tarea para este evento.']);
        }

        $task->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'due_date' => $validated['due_date'],
            'event_id' => $validated['event_id'],
            'status_id' => $validated['status_id'],
        ]);

        return redirect()->route('tasks.index')->with('success', 'Tarea actualizada exitosamente.');
    }
}
