@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto py-8">
        <h1 class="text-2xl font-bold mb-4 text-center">Añadir Colaboradores al Evento: {{ $event->description }}</h1>

        <!-- Mensaje de éxito -->
        @if (session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">¡Éxito!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer" onclick="this.parentElement.remove();">
                    <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <title>Cerrar</title>
                        <path
                            d="M14.348 14.849a1 1 0 01-1.414 0L10 11.915l-2.935 2.934a1 1 0 01-1.414-1.414l2.935-2.934-2.935-2.934a1 1 0 011.414-1.414L10 9.086l2.934-2.935a1 1 0 011.414 1.414L11.415 10l2.933 2.934a1 1 0 010 1.415z" />
                    </svg>
                </span>
            </div>
        @endif

        <!-- Mensaje de error -->
        @if (session('error'))
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">¡Error!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer"
                    onclick="this.parentElement.remove();">
                    <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <title>Cerrar</title>
                        <path
                            d="M14.348 14.849a1 1 0 01-1.414 0L10 11.915l-2.935 2.934a1 1 0 01-1.414-1.414l2.935-2.934-2.935-2.934a1 1 0 011.414-1.414L10 9.086l2.934-2.935a1 1 0 011.414 1.414L11.415 10l2.933 2.934a1 1 0 010 1.415z" />
                    </svg>
                </span>
            </div>
        @endif

        <!-- Formulario para añadir colaboradores -->
        <form action="{{ route('events.storeCollaboration', $event) }}"method="POST"
            class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            <div class="mb-4">
                <label for="user_email" class="block text-gray-700 text-sm font-bold mb-2">Correo electrónico del
                    colaborador:</label>
                <input type="email" name="email" id="user_email"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    placeholder="ejemplo@correo.com">
            </div>

            <div class="flex items-center justify-between">
                <button type="submit"
                    class="bg-gray-700 hover:bg-gray-500 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Añadir Colaborador
                </button>
                <a href="{{ route('events.index') }}"
                    class="inline-block align-baseline font-bold text-sm text-gray-500 hover:text-gray-800">
                    Volver a mis eventos
                </a>
            </div>
        </form>

        <!-- Lista de colaboradores actuales -->
        <div class="mt-6">
            <h2 class="text-xl font-semibold mb-2">Colaboradores actuales</h2>
            @if ($event->collaborations->count() > 0)
                <ul class="">
                    @foreach ($event->collaborations as $collaborator)
                        <li class="flex items-center gap-2">
                            <i class="fas fa-user text-gray-400"></i>
                            <span class="font-semibold">{{ $collaborator->name ?? 'Sin nombre' }}</span>
                            <span class="text-gray-500">&lt;{{ $collaborator->email ?? 'Sin correo' }}&gt;</span>
                            <button type="button"
                                class="flex items-center gap-1 px-2 py-1 text-sm text-gray-700 rounded transition"
                                onclick="Livewire.emit('openDeleteModal', {{ $event->id }}, {{ $collaborator->id }})">
                                <i class="fas fa-trash-alt fa-xl"></i>
                            </button>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-600">No hay colaboradores aún.</p>
            @endif
        </div>
    </div>
    <livewire:confirm-delete-collaboration-modal />
 
@endsection
