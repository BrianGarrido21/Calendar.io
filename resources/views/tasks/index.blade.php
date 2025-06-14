@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto py-8">
        <h1 class="text-3xl font-bold mb-4 text-center">Mis Tareas</h1>

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
            <a href="{{ route('tasks.create') }}"
                class="bg-gray-700 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded shadow transition">
                <i class="fas fa-plus mr-2"></i> Crear Tarea
            </a>
        </div>

        <form method="GET" class="mb-6 bg-white p-4 rounded shadow flex flex-wrap items-center gap-4 justify-center">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar por título"
                class="border-gray-300 rounded px-3 py-2 text-sm focus:ring focus:ring-indigo-200">

            <input type="date" name="due_date" value="{{ request('due_date') }}"
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
                class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-500 transition text-sm">
                Filtrar
            </button>

            <a href="{{ route('tasks.index') }}" class="text-sm text-gray-600 underline hover:text-gray-800">Limpiar
                filtros</a>
        </form>
        <div class="bg-white shadow rounded-lg overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-base">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600 uppercase">Título</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600 uppercase">Fecha límite</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600 uppercase">Evento</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600 uppercase">Estado</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600 uppercase">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($tasks as $task)
                        <tr>
                            <td class="px-6 py-3 whitespace-nowrap text-gray-900">
                                {{ $task->title ?? 'Sin título' }}
                            </td>
                            <td class="px-6 py-3 whitespace-nowrap text-gray-500">
                                {{ \Carbon\Carbon::parse($task->due_date)->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-3 whitespace-nowrap text-gray-900">
                                @if ($task->event)
                                    {{ $task->event->description ?? 'Sin descripción' }}
                                @else
                                    Sin evento
                                @endif
                            </td>
                            <td class="px-6 py-3 whitespace-nowrap">
                                <span class="inline-block px-3 py-1 rounded-full text-white text-xs"
                                    style="background-color: {{ $task->status->color ?? '#999' }}">
                                    {{ $task->status->name ?? 'Sin estado' }}
                                </span>
                            </td>
                            <td class="px-6 py-3 text-gray-500">
                                <div class="flex items-center gap-4 w-max">
                                    <!-- Show -->
                                    <a href="{{ route('tasks.show', $task) }}"
                                        class="text-gray-700 hover:text-gray-600 transition">
                                        <i class="fas fa-eye fa-xl"></i>
                                    </a>

                                    @if ($task->event && $task->event->isOwner())
                                        <!-- Edit -->
                                        <a href="{{ route('tasks.edit', $task) }}"
                                            class="text-gray-700 hover:text-gray-600 transition">
                                            <i class="fas fa-edit fa-xl"></i>
                                        </a>

                                        <!-- Delete -->
                                        <button type="button" class="text-gray-700 hover:text-gray-600 transition"
                                            onclick="Livewire.emit('openDeleteTaskModal', {{ $task->id }})">
                                            <i class="fas fa-trash fa-xl"></i>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                No hay tareas registradas.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
        <div class="mt-6 flex justify-center">
            {{ $tasks->appends(request()->query())->links() }}
        </div>


    </div>

    <livewire:delete-task-confirm-modal />
@endsection
