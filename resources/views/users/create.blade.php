@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-8">
    <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">Crear Nuevo Usuario</h1>

    <form action="{{ route('users.store') }}" method="POST" class="bg-white shadow-md rounded-2xl p-8 space-y-6">
        @csrf

        <!-- Nombre -->
        <div>
            <label class="block text-gray-700 font-semibold mb-2" for="name">
                <i class="fas fa-user mr-2 text-gray-500"></i> Nombre
            </label>
            <input type="text" name="name" id="name"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-700 transition"
                placeholder="Nombre del usuario" value="{{ old('name') }}">
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Correo electrónico -->
        <div>
            <label class="block text-gray-700 font-semibold mb-2" for="email">
                <i class="fas fa-envelope mr-2 text-gray-500"></i> Correo electrónico
            </label>
            <input type="email" name="email" id="email"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-700 transition"
                placeholder="Correo electrónico" value="{{ old('email') }}">
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Contraseña -->
        <div>
            <label class="block text-gray-700 font-semibold mb-2" for="password">
                <i class="fas fa-lock mr-2 text-gray-500"></i> Contraseña
            </label>
            <input type="password" name="password" id="password"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-700 transition"
                placeholder="Contraseña">
            @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirmación de contraseña -->
        <div>
            <label class="block text-gray-700 font-semibold mb-2" for="password_confirmation">
                <i class="fas fa-lock mr-2 text-gray-500"></i> Confirmar Contraseña
            </label>
            <input type="password" name="password_confirmation" id="password_confirmation"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-700 transition"
                placeholder="Confirma la contraseña">
        </div>

        <!-- Administrador -->
        <div>
            <label class="inline-flex items-center">
                <input type="checkbox" name="is_admin" class="form-checkbox text-gray-700 transition" {{ old('is_admin') ? 'checked' : '' }}>
                <span class="ml-2 text-gray-700">¿Es administrador?</span>
            </label>
        </div>

        <!-- Botones -->
        <div class="flex justify-end gap-2 pt-4">
            <button type="submit"
                class="flex items-center gap-1 bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded shadow transition">
                <i class="fas fa-plus"></i> Crear Usuario
            </button>
        </div>
    </form>
</div>
@endsection
