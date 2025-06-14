@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-8">
    <h1 class="text-3xl font-bold mb-8 text-center">Editar Evento</h1>

    <div class="bg-white shadow rounded-lg p-6">
        <form action="{{ route('events.update', $event) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="flex flex-col md:flex-row gap-8">
                <!-- Columna izquierda -->
                <div class="flex-1 space-y-4" >
                    <!-- Descripción -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Descripción</label>
                        <input type="text" name="description" id="description"
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"
                               value="{{ old('description', $event->description) }}">
                        @error('description')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Ubicación (opcional) -->
                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700">Ubicación (opcional)</label>
                        <input type="text" name="location" id="location"
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"
                               value="{{ old('location', $event->location) }}">
                        @error('location')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Estado -->
                    <div>
                        <label for="status_id" class="block text-sm font-medium text-gray-700">Estado</label>
                        <select name="status_id" id="status_id"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                            <option value="">Selecciona un estado</option>
                            @foreach ($statuses as $status)
                                <option value="{{ $status->id }}"
                                    {{ old('status_id', $event->status_id) == $status->id ? 'selected' : '' }}>
                                    {{ $status->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('status_id')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Separador vertical -->
                <div class="hidden md:flex justify-center items-stretch">
                    <div class="w-px bg-gray-300"></div>
                </div>

                <!-- Columna derecha -->
                <div class="flex-1 space-y-4">
                    <!-- Fecha y hora de inicio -->
                    <div>
                        <label for="start_datetime" class="block text-sm font-medium text-gray-700">Inicio</label>
                        <input type="datetime-local" name="start_datetime" id="start_datetime"
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"
                               value="{{ old('start_datetime', \Carbon\Carbon::parse($event->start_datetime)->format('Y-m-d\TH:i')) }}">
                        @error('start_datetime')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Fecha y hora de fin -->
                    <div>
                        <label for="end_datetime" class="block text-sm font-medium text-gray-700">Fin</label>
                        <input type="datetime-local" name="end_datetime" id="end_datetime"
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"
                               value="{{ old('end_datetime', \Carbon\Carbon::parse($event->end_datetime)->format('Y-m-d\TH:i')) }}">
                        @error('end_datetime')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Multiselect de tags -->
                    <div>
                        <label for="tags" class="block text-sm font-medium text-gray-700">Etiquetas</label>
                        <select name="tags[]" id="tags" multiple
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                            @foreach ($tags as $tag)
                                <option value="{{ $tag->id }}"
                                    {{ (collect(old('tags', $event->tags->pluck('id')->toArray()))->contains($tag->id)) ? 'selected' : '' }}>
                                    {{ $tag->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('tags')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Botón de envío -->
            <div class="mt-6 flex justify-center gap-2">
                <a href="{{ route('events.index') }}"
                   class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-2 px-4 rounded shadow transition flex items-center gap-1">
                    <i class="fas fa-arrow-left"></i> Volver
                </a>
                <button type="submit"
                        class="bg-gray-700 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded shadow transition">
                    <i class="fas fa-save mr-2"></i> Guardar Cambios
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
