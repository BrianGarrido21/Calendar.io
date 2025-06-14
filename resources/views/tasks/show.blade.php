@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto py-8">
        @if ($task)
            <div class="bg-white rounded-2xl shadow-2xl p-8 space-y-6">
                <div class="flex items-center gap-2 mb-4">
                    <i class="fas fa-tasks text-gray-700 text-3xl"></i>
                    <h2 class="text-3xl font-bold text-gray-800">Detalles de la Tarea</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-gray-700">
                    <div class="space-y-2">
                        <p>
                            <i class="fas fa-hashtag text-gray-400"></i>
                            <strong>ID:</strong> {{ $task->id }}
                        </p>
                        <p>
                            <i class="fas fa-heading text-gray-400"></i>
                            <strong>Título:</strong> {{ $task->title ?? 'Sin título' }}
                        </p>
                        <p>
                            <i class="fas fa-align-left text-gray-400"></i>
                            <strong>Descripción:</strong> {{ $task->description ?? 'No especificada' }}
                        </p>
                        <p>
                            <i class="fas fa-calendar-day text-gray-400"></i>
                            <strong>Fecha límite:</strong>
                            {{ \Carbon\Carbon::parse($task->due_date)->format('d/m/Y') ?? 'No especificada' }}
                        </p>
                    </div>

                    <div class="space-y-2">
                        <p>
                            <i class="fas fa-calendar-alt text-gray-400"></i>
                            <strong>Evento asociado:</strong>
                            @if ($task->event)
                                <a href="{{ route('events.show', $task->event) }}" class="text-blue-600 hover:underline">
                                    {{ $task->event->description ?? 'Sin descripción' }}
                                </a>
                            @else
                                No asociado
                            @endif
                        </p>
                        <div class="flex items-center gap-2">
                            <i class="fas fa-check-circle text-gray-400"></i>
                            <strong>Estado:</strong>
                            <span class="px-3 py-1 rounded-full text-white text-sm"
                                style="background-color: {{ $task->status->color ?? '#999' }}">
                                {{ $task->status->name ?? 'Sin estado' }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex justify-end gap-2">
                    <a href="{{ route('tasks.edit', $task) }}"
                        class="flex items-center gap-1 bg-gray-700 hover:bg-gray-600 text-white px-3 py-2 rounded transition">
                        <i class="fas fa-edit"></i> Editar
                    </a>
                    <a href="{{ url()->previous() }}"
                        class="flex items-center gap-1 text-white px-3 py-2 rounded bg-gray-700 hover:bg-gray-600 transition">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                </div>
            </div>
        @else
            <div class="text-center text-gray-500 flex flex-col items-center gap-2">
                <i class="fas fa-exclamation-triangle text-3xl text-yellow-500"></i>
                <p>No se encontró la tarea.</p>
                <a href="{{ route('tasks.index') }}"
                    class="mt-4 bg-gray-500 text-white px-3 py-2 rounded hover:bg-gray-600 transition">Volver</a>
            </div>
        @endif
    </div>
@endsection
