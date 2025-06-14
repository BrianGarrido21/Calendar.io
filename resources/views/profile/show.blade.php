@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-8">
    <h1 class="text-3xl font-bold mb-6 text-center">Perfil</h1>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" class="bg-white shadow-md rounded-2xl p-8 space-y-6">
        @csrf
        @method('PUT')

        <!-- Nombre -->
        <div>
            <label for="name" class="block text-gray-700 font-semibold mb-2">Nombre</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-700 transition">
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-gray-700 font-semibold mb-2">Correo electrónico</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-700 transition">
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <hr class="my-6">

        <h2 class="text-xl font-semibold mb-4 text-gray-700">Cambiar contraseña</h2>

        <!-- Contraseña actual -->
        <div>
            <label for="current_password" class="block text-gray-700 font-semibold mb-2">Contraseña actual</label>
            <input type="password" name="current_password" id="current_password"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-700 transition"
                autocomplete="current-password" placeholder="Introduce tu contraseña actual">
            @error('current_password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Nueva contraseña -->
        <div>
            <label for="password" class="block text-gray-700 font-semibold mb-2">Nueva contraseña</label>
            <input type="password" name="password" id="password"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-700 transition"
                autocomplete="new-password" placeholder="Nueva contraseña (mínimo 8 caracteres)">
            @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirmar nueva contraseña -->
        <div>
            <label for="password_confirmation" class="block text-gray-700 font-semibold mb-2">Confirmar nueva contraseña</label>
            <input type="password" name="password_confirmation" id="password_confirmation"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-700 transition"
                autocomplete="new-password" placeholder="Confirma la nueva contraseña">
        </div>

        <!-- Botón Guardar -->
        <div class="flex justify-end pt-4">
            <button type="submit" class="bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded shadow transition">
                Guardar cambios
            </button>
        </div>
    </form>
</div>
@endsection
