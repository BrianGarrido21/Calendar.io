@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto py-8">
        <h1 class="text-3xl font-bold mb-4 text-center">Gestión de Etiquetas</h1>

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
            <a href="{{ route('tags.create') }}"
                class="bg-gray-700 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded shadow transition">
                <i class="fas fa-plus mr-2"></i> Crear Etiqueta
            </a>
        </div>

        <div class="bg-white shadow rounded-lg overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-base">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600 uppercase">Nombre</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600 uppercase">Color</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600 uppercase">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($tags as $tag)
                        <tr>
                            <td class="px-6 py-3 whitespace-nowrap text-gray-900">
                                {{ $tag->name ?? 'Sin nombre' }}
                            </td>
                            <td class="px-6 py-3 whitespace-nowrap">
                                <span class="inline-block px-3 py-1 rounded-full text-white text-xs"
                                    style="background-color: {{ $tag->color ?? '#999' }}">
                                    {{ $tag->color ?? 'Sin color' }}
                                </span>
                            </td>
                            <td class="px-6 py-3 text-gray-500">
                                <div class="flex items-center gap-4 w-max">

                                    <a href="{{ route('tags.edit', $tag) }}"
                                        class="text-gray-700 hover:text-gray-600 transition">
                                        <i class="fas fa-edit fa-xl"></i>
                                    </a>

                                        <button type="button" class="text-gray-700 hover:text-gray-600 transition"
                                            onclick="Livewire.emit('openDeleteTagModal', {{ $tag->id }})">
                                            <i class="fas fa-trash fa-xl"></i>
                                        </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                No hay tags registrados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6 flex justify-center">
            {{ $tags->links() }}
        </div>
    </div>
    <livewire:tag-delete-modal />
@endsection
