@extends('layouts.app')

@section('content')
    <livewire:delete-event-modal />

    <div class="max-w-6xl mx-auto py-8">
        <h1 class="text-3xl font-bold mb-4 text-center">Mis Eventos</h1>

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
        <div class="mb-8 flex justify-center">
            <a href="{{ route('events.create') }}"
                class="bg-gray-700 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded shadow transition">
                <i class="fas fa-plus mr-2"></i> Crear Evento
            </a>
        </div>
        <form method="GET" class="mb-6 bg-white p-4 rounded shadow flex flex-wrap items-center gap-4 justify-center">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar por título"
                class="border-gray-300 rounded px-3 py-2 text-sm focus:ring focus:ring-indigo-200">

            <input type="date" name="date" value="{{ request('date') }}"
                class="border-gray-300 rounded px-3 py-2 text-sm focus:ring focus:ring-indigo-200">

            <select name="status" class="border-gray-300 rounded px-3 py-2 text-sm focus:ring focus:ring-indigo-200">
                <option value="">Todos los estados</option>
                @foreach ($statuses as $status)
                    <option value="{{ $status->id }}" {{ request('status') == $status->id ? 'selected' : '' }}>
                        {{ $status->name }}
                    </option>
                @endforeach
            </select>

            <button type="submit"
                class="bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-500 transition text-sm">
                Filtrar
            </button>

            <a href="{{ route('events.index') }}" class="text-sm text-gray-600 underline hover:text-gray-800">Limpiar
                filtros</a>
        </form>
        <div class="bg-white shadow rounded-lg overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-base">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600 uppercase">Título</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600 uppercase">Inicio</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600 uppercase">Fin</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600 uppercase">Estado</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600 uppercase">Usuario</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600 uppercase">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($events as $event)
                        <tr>
                            <td class="px-6 py-3 whitespace-nowrap text-gray-900">
                                {{ $event->description ?? 'Sin título' }}
                            </td>
                            <td class="px-6 py-3 whitespace-nowrap text-gray-500">
                                {{ \Carbon\Carbon::parse($event->start_datetime)->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-6 py-3 whitespace-nowrap text-gray-500">
                                {{ \Carbon\Carbon::parse($event->end_datetime)->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-6 py-3 whitespace-nowrap">
                                <span class="inline-block px-3 py-1 rounded-full text-white text-xs"
                                    style="background-color: {{ $event->status->color ?? '#999' }}">
                                    {{ $event->status->name ?? 'Sin estado' }}
                                </span>
                            </td>
                            <td class="px-6 py-3 whitespace-nowrap text-gray-900">
                                {{ $event->user->name ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-3 text-gray-500">
                                <div class="grid grid-cols-2 gap-4 w-max">
                                    <!-- Show -->
                                    <a href="{{ route('events.show', $event) }}"
                                        class="text-gray-700 hover:text-gray-600 transition">
                                        <i class="fas fa-eye fa-xl"></i>
                                    </a>

                                    @if ($event->isOwner())
                                        <!-- Colaboraciones -->
                                        <a href="{{ route('events.createCollaborations', $event) }}"
                                            class="text-gray-700 hover:text-gray-600 transition">
                                            <i class="fas fa-person fa-xl"></i>
                                        </a>

                                        <!-- Edit -->
                                        <a href="{{ route('events.edit', $event) }}"
                                            class="text-gray-700 hover:text-gray-600 transition">
                                            <i class="fas fa-edit fa-xl"></i>
                                        </a>

                                        <!-- Delete -->
                                        <button type="button" class="text-gray-700 hover:text-gray-600 transition"
                                            onclick="Livewire.emit('openDeleteEventModal', {{ $event->id }})">
                                            <i class="fas fa-trash fa-xl"></i>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                No hay eventos registrados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
        <div class="mt-6 flex justify-center">
            {{ $events->appends(request()->query())->links() }}
        </div>


    </div>
@endsection
