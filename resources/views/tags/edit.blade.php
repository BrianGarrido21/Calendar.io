@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-8">
    <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">Editar Tag</h1>

    <form action="{{ route('tags.update', $tag) }}" method="POST" class="bg-white shadow-md rounded-2xl p-8 space-y-6">
        @csrf
        @method('PUT')

        <!-- Nombre -->
        <div>
            <label class="block text-gray-700 font-semibold mb-2" for="name">
                <i class="fas fa-tag mr-2 text-gray-500"></i> Nombre
            </label>
            <input type="text" name="name" id="name"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-700 transition"
                placeholder="Nombre del tag" value="{{ old('name', $tag->name) }}">
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Color -->
        <div>
            <label class="block text-gray-700 font-semibold mb-2" for="color">
                <i class="fas fa-palette mr-2 text-gray-500"></i> Color
            </label>
            <input type="color" name="color" id="color"
                class="w-16 h-10 border rounded focus:outline-none focus:ring-2 focus:ring-gray-700 transition"
                value="{{ old('color', $tag->color ?? '#000000') }}">
            @error('color')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Botones -->
        <div class="flex justify-end gap-2 pt-4">
            <button type="submit"
                class="flex items-center gap-1 bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded shadow transition">
                <i class="fas fa-save"></i> Actualizar Tag
            </button>
        </div>
    </form>
</div>
@endsection
