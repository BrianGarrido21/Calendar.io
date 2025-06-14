@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto py-8">
        @if ($event)
            <div class="bg-white rounded-2xl shadow-2xl p-8 space-y-6">
                <div class="flex items-center gap-2 mb-4">
                    <i class="fas fa-calendar-alt text-gray-700 text-3xl"></i>
                    <h2 class="text-3xl font-bold text-gray-800">Detalles del Evento</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-gray-700">
                    <div class="space-y-2">
                        <p><i class="fas fa-heading text-gray-400"></i>
                            <strong>Descripción:</strong> {{ $event->description }}
                        </p>
                        <p><i class="fas fa-map-marker-alt text-gray-400"></i>
                            <strong>Ubicación:</strong> {{ $event->location ?? 'No especificada' }}
                        </p>
                        <p><i class="fas fa-play text-gray-400"></i>
                            <strong>Inicio:</strong>
                            {{ \Carbon\Carbon::parse($event->start_datetime)->format('d/m/Y H:i') }}
                        </p>
                        <p><i class="fas fa-stop text-gray-400"></i>
                            <strong>Fin:</strong> {{ \Carbon\Carbon::parse($event->end_datetime)->format('d/m/Y H:i') }}
                        </p>
                    </div>

                    <div class="space-y-2">
                        <p><i class="fas fa-user text-gray-400"></i>
                            <strong>Usuario:</strong> {{ $event->user->name ?? 'N/A' }}
                        </p>
                        <div class="flex items-center gap-2">
                            <i class="fas fa-check-circle text-gray-400"></i>
                            <strong>Estado:</strong>
                            <span class="px-3 py-1 rounded-full text-white text-sm"
                                style="background-color: {{ $event->status->color ?? '#999' }}">
                                {{ $event->status->name }}
                            </span>
                        </div>
                    </div>
                </div>


                <div class="mt-6">
                    <div class="flex items-center gap-2 mb-2">
                        <h3 class="flex items-center gap-1 text-xl font-semibold">
                            <i class="fas fa-tasks text-gray-700"></i> Tareas
                        </h3>
                        @if ($event->isOwner())
                            <a href="{{ route('tasks.create') }}"
                                class="flex items-center gap-1 bg-gray-700 text-white px-3 py-1 text-sm rounded hover:bg-gray-500 transition">
                                <i class="fas fa-plus"></i> Añadir Tarea
                            </a>
                        @endif
                    </div>

                    @if ($event->tasks && $event->tasks->count())
                        <ul class="list-disc list-inside text-gray-700">
                            @foreach ($event->tasks as $task)
                                <li class="text-gray-800 hover:underline cursor-pointer flex items-center gap-1">
                                    <i class="fas fa-chevron-right text-xs"></i>
                                    <a href="{{ route('tasks.show', $task) }}">
                                        {{ $task->title ?? 'Sin título' }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-500">No hay tareas asociadas a este evento.</p>
                    @endif
                </div>

                <div class="mt-6">
                    <div class="flex items-center gap-2 mb-2">
                        <h3 class="flex items-center gap-1 text-xl font-semibold">
                            <i class="fas fa-tags text-gray-700"></i> Etiquetas
                        </h3>
                        @if ($event->isOwner())
                            <button onclick="Livewire.emit('openTagModal', {{ $event->id }})"
                                class="flex items-center gap-1 bg-gray-700 text-white px-3 py-1 text-sm rounded hover:bg-gray-500 transition">
                                <i class="fas fa-plus"></i> Añadir Etiqueta
                            </button>
                        @endif
                    </div>

                    @if ($event->tags && $event->tags->count())
                        <div class="flex flex-wrap gap-2">
                            @foreach ($event->tags as $tag)
                                <span class="px-3 py-1 rounded-full text-white text-sm"
                                    style="background-color: {{ $tag->color ?? '#666' }}">
                                    {{ $tag->name }}
                                </span>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500">No hay etiquetas asociadas a este evento.</p>
                    @endif
                </div>


                <div class="mt-6">
                    <div class="flex items-center gap-2 mb-2">
                        <h3 class="flex items-center gap-1 text-xl font-semibold">
                            <i class="fas fa-users text-gray-700"></i> Colaboradores
                        </h3>
                        @if ($event->isOwner())
                            <a href="{{ route('events.createCollaborations', $event->id) }}"
                                class="flex items-center gap-1 bg-gray-700 text-white px-3 py-1 text-sm rounded hover:bg-gray-500 transition">
                                <i class="fas fa-plus"></i> Añadir colaboladores
                            </a>
                        @endif
                    </div>

                    @if ($event->collaborations && $event->collaborations->count())
                        <ul class="text-gray-700 space-y-2">
                            @foreach ($event->collaborations as $collab)
                                <li class="flex items-center gap-2">
                                    <i class="fas fa-user text-gray-400"></i>
                                    <span class="font-semibold">{{ $collab->name ?? 'Sin nombre' }}</span>
                                    <span class="text-gray-500">&lt;{{ $collab->email ?? 'Sin correo' }}&gt;</span>
                                    @if ($event->isOwner())
                                        <button type="button"
                                            class="flex items-center gap-1 px-2 py-1 text-sm text-gray-700 rounded transition"
                                            onclick="Livewire.emit('openDeleteModal', {{ $event->id }}, {{ $collab->id }})">
                                            <i class="fas fa-trash-alt fa-xl"></i>
                                        </button>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-500">No hay colaboradores asociados a este evento.</p>
                    @endif
                </div>


                <div class="mt-6 flex justify-end gap-2">
                    @if ($event->isOwner())
                        <a href="{{ route('events.edit', $event) }}"
                            class="flex items-center gap-1 bg-gray-700 hover:bg-gray-600 text-white px-3 py-2 rounded transition">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                    @endif
                    <a href="{{ url()->previous() }}"
                        class="flex items-center gap-1 text-white px-3 py-2 rounded bg-gray-700 hover:bg-gray-600 transition">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                </div>
            </div>
        @else
            <div class="text-center text-gray-500 flex flex-col items-center gap-2">
                <i class="fas fa-exclamation-triangle text-3xl text-yellow-500"></i>
                <p>No se encontró el evento.</p>
                <a href="{{ route('events.index') }}"
                    class="mt-4 bg-gray-500 text-white px-3 py-2 rounded hover:bg-gray-600 transition">Volver</a>
            </div>
        @endif
    </div>
    <livewire:confirm-delete-collaboration-modal />
    <livewire:event-tag-selector />
@endsection
