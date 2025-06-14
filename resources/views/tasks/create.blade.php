@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-8">
    <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">Crear Nueva Tarea</h1>

    <form action="{{ route('tasks.store') }}" method="POST" class="bg-white shadow-md rounded-2xl p-8 space-y-6">
        @csrf

        <!-- Título -->
        <div>
            <label class="block text-gray-700 font-semibold mb-2" for="title">
                <i class="fas fa-heading mr-2 text-gray-500"></i> Título
            </label>
            <input type="text" name="title" id="title" 
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-700 transition"
                placeholder="Título de la tarea" value="{{ old('title') }}">
            @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Descripción -->
        <div>
            <label class="block text-gray-700 font-semibold mb-2" for="description">
                <i class="fas fa-align-left mr-2 text-gray-500"></i> Descripción
            </label>
            <textarea name="description" id="description" rows="3"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-700 transition"
                placeholder="Descripción de la tarea">{{ old('description') }}</textarea>
            @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Fecha Límite -->
        <div>
            <label class="block text-gray-700 font-semibold mb-2" for="due_date">
                <i class="fas fa-calendar-alt mr-2 text-gray-500"></i> Fecha límite
            </label>
            <input type="datetime-local" name="due_date" id="due_date" 
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-700 transition"
                value="{{ old('due_date') }}">
            @error('due_date')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Evento -->
        <div>
            <label class="block text-gray-700 font-semibold mb-2" for="event_id">
                <i class="fas fa-calendar mr-2 text-gray-500"></i> Evento
            </label>
            <select name="event_id" id="event_id"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-700 transition">
                <option value="">-- Selecciona un evento --</option>
                @forelse ($events as $event)
                    <option value="{{ $event->id }}" @selected(old('event_id') == $event->id)>
                        {{ $event->description ?? 'Sin descripción' }}
                    </option>
                @empty
                    <option disabled>No tienes eventos disponibles</option>
                @endforelse
            </select>
            @error('event_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Estado -->
        <div>
            <label class="block text-gray-700 font-semibold mb-2" for="status_id">
                <i class="fas fa-flag mr-2 text-gray-500"></i> Estado
            </label>
            <select name="status_id" id="status_id"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-700 transition">
                <option value="">-- Selecciona un estado --</option>
                @foreach ($statuses as $status)
                    <option value="{{ $status->id }}" @selected(old('status_id') == $status->id)>
                        {{ $status->name }}
                    </option>
                @endforeach
            </select>
            @error('status_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Botones -->
        <div class="flex justify-end gap-2 pt-4">
            <button type="submit"
                class="flex items-center gap-1 bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded shadow transition">
                <i class="fas fa-plus"></i> Crear Tarea
            </button>
        </div>
    </form>
</div>
@endsection
