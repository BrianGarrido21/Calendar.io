@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto py-8">
        @if ($user)
            <div class="bg-white rounded-2xl shadow-2xl p-8 space-y-6">
                <div class="flex items-center gap-2 mb-4">
                    <i class="fas fa-user text-gray-700 text-3xl"></i>
                    <h2 class="text-3xl font-bold text-gray-800">Detalles del Usuario</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-gray-700">
                    <div class="space-y-2">
                        <p>
                            <i class="fas fa-hashtag text-gray-400"></i>
                            <strong>ID:</strong> {{ $user->id }}
                        </p>
                        <p>
                            <i class="fas fa-user text-gray-400"></i>
                            <strong>Nombre:</strong> {{ $user->name }}
                        </p>
                        <p>
                            <i class="fas fa-envelope text-gray-400"></i>
                            <strong>Email:</strong> {{ $user->email }}
                        </p>
                    </div>

                    <div class="space-y-2">
                        <p>
                            <i class="fas fa-user-shield text-gray-400"></i>
                            <strong>Rol:</strong>
                            @if ($user->is_admin)
                                <span class="px-3 py-1 rounded-full text-white text-sm bg-gray-700">Administrador</span>
                            @else
                                <span class="px-3 py-1 rounded-full text-white text-sm bg-gray-500">Usuario</span>
                            @endif
                        </p>
                    </div>
                </div>

                <div class="mt-6 flex justify-end gap-2">
                    <a href="{{ route('users.edit', $user) }}"
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
                <p>No se encontró el usuario.</p>
                <a href="{{ route('users.index') }}"
                    class="mt-4 bg-gray-500 text-white px-3 py-2 rounded hover:bg-gray-600 transition">Volver</a>
            </div>
        @endif
    </div>
@endsection
