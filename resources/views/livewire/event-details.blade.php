<div x-data="{ open: @entangle('modalVisible') }">
    <!-- Fondo oscuro -->
    <div x-show="open" class="fixed inset-0 bg-black bg-opacity-50 z-40" @click="open = false"></div>

    <!-- Modal -->
    <div x-show="open" x-transition class="fixed z-50 inset-0 flex items-center justify-center p-4 overflow-y-auto">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-4xl p-8 relative space-y-6 max-h-[90vh] overflow-y-auto">
            <!-- Botón cerrar -->
            <button @click="open = false"
                class="absolute top-4 right-4 text-gray-500 hover:text-red-500 text-2xl font-bold transition">
                <i class="fas fa-times"></i>
            </button>

            @if ($event)
                <div class="flex items-center gap-2 mb-4">
                    <i class="fas fa-calendar-alt text-gray-700 text-3xl"></i>
                    <h2 class="text-3xl font-bold text-gray-800">Detalles</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-gray-700">
                    <div class="space-y-2">
                        <p><i class="fas fa-heading text-gray-400"></i>
                            <strong>Título:</strong> {{ $event['title'] ?? 'No especificado' }}
                        </p>
                        <p><i class="fas fa-calendar-day text-gray-400"></i>
                            <strong>Inicio:</strong>
                            {{ \Carbon\Carbon::parse($event['start'])->format('d/m/Y') }}
                        </p>
                        <p><i class="fas fa-calendar-day text-gray-400"></i>
                            <strong>Fin:</strong>
                            {{ \Carbon\Carbon::parse($event['end'])->format('d/m/Y') }}
                        </p>
                    </div>

                    <div class="space-y-2">
                        @if (isset($event['extendedProps']['description']))
                            <p><i class="fas fa-align-left text-gray-400"></i>
                                <strong>Descripción:</strong>
                                {{ $event['extendedProps']['description'] }}
                            </p>
                        @endif
                        @if (isset($event['extendedProps']['locations']))
                            <p><i class="fas fa-map-marker-alt text-gray-400"></i>
                                <strong>Ubicación:</strong>
                                {{ $event['extendedProps']['locations'] }}
                            </p>
                        @elseif (isset($event['extendedProps']['location']))
                            <p><i class="fas fa-map-marker-alt text-gray-400"></i>
                                <strong>Ubicación:</strong>
                                {{ $event['extendedProps']['location'] }}
                            </p>
                        @endif

                        @if (isset($event['extendedProps']['type']))
                            <p><i class="fas fa-tags text-gray-400"></i>
                                <strong>Tipo:</strong>
                                {{ is_array($event['extendedProps']['type']) ? implode(', ', $event['extendedProps']['type']) : $event['extendedProps']['type'] }}
                            </p>
                        @endif
                    </div>
                </div>

                <!-- Info de usuario solo si existe -->
                @if (isset($event['extendedProps']['user_name']))
                    <div class="mt-4">
                        <p><i class="fas fa-user text-gray-400"></i>
                            <strong>Usuario:</strong>
                            {{ $event['extendedProps']['user_name']['name'] ?? 'N/A' }}
                        </p>
                    </div>
                @endif

                <!-- Info de status si existe -->
                @if (isset($event['extendedProps']['status']))
                    <div class="mt-4 flex items-center gap-2">
                        <i class="fas fa-check-circle text-gray-400"></i>
                        <strong>Status:</strong>
                        <span class="px-3 py-1 rounded-full text-white text-sm"
                            style="background-color: {{ $event['extendedProps']['status']['color'] ?? '#999' }}">
                            {{ $event['extendedProps']['status']['name'] }}
                        </span>
                    </div>
                @endif

                <!-- Tareas si existen -->
                @if (isset($event['extendedProps']['tasks']) && count($event['extendedProps']['tasks']))
                    <div class="mt-6">
                        <h3 class="flex items-center gap-1 text-xl font-semibold mb-2">
                            <i class="fas fa-tasks text-gray-700"></i> Tareas
                        </h3>
                        <ul class="list-disc list-inside text-gray-700">
                            @foreach ($event['extendedProps']['tasks'] as $task)
                                <li class="text-gray-800 hover:underline cursor-pointer flex items-center gap-1">
                                    <i class="fas fa-chevron-right text-xs"></i>
                                    <span wire:click="$emit('showTaskModal', {{ $task['id'] }})">
                                        {{ $task['title'] ?? 'Sin título' }}
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @elseif (isset($event['extendedProps']['tasks']))
                    <p class="text-gray-500 mt-6">No hay tareas registradas.</p>
                @endif

                <!-- Colaboradores si existen -->
                @if (isset($event['extendedProps']['collaborations']))
                    <div class="mt-6">
                        <h3 class="flex items-center gap-1 text-xl font-semibold mb-2">
                            <i class="fas fa-users text-gray-700"></i> Colaboradores
                        </h3>
                        @if (count($event['extendedProps']['collaborations']))
                            <ul class="text-gray-700 space-y-2">
                                @foreach ($event['extendedProps']['collaborations'] as $collab)
                                    <li class="flex items-center gap-2">
                                        <i class="fas fa-user text-gray-400"></i>
                                        <span class="font-semibold">{{ $collab['name'] ?? 'Sin nombre' }}</span>
                                        <span
                                            class="text-gray-500">&lt;{{ $collab['email'] ?? 'Sin correo' }}&gt;</span>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-gray-600">No hay colaboradores aún.</p>
                        @endif
                    </div>
                @endif

                <!-- Nueva sección de etiquetas (si no tiene type) -->
                @if (!isset($event['extendedProps']['type']) && isset($event['extendedProps']['tags']))
                    <div class="mt-6">
                        <h3 class="flex items-center gap-1 text-xl font-semibold mb-2">
                            <i class="fas fa-tags text-gray-700"></i> Etiquetas
                        </h3>
                        @if (count($event['extendedProps']['tags']))
                            <div class="flex flex-wrap gap-2">
                                @foreach ($event['extendedProps']['tags'] as $tag)
                                    <span
                                        class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-sm font-semibold text-white"
                                        style="background-color: {{ $tag['color'] ?? '#777' }}">
                                        <i class="fas fa-tag"></i>
                                        {{ $tag['name'] }}
                                    </span>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500">No hay etiquetas registradas.</p>
                        @endif
                    </div>
                @endif

                @if (!isset($event['extendedProps']['type']))
                    <div class="mt-8 flex justify-end gap-3">
                        <a href="{{ route('events.show', $event['extendedProps']['id']) }}"
                            class="flex items-center gap-2 bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-500 transition text-lg">
                            <i class="fas fa-cogs"></i> Gestionar evento
                        </a>
                    </div>
                @endif
            @else
                <div class="text-center text-gray-500 flex flex-col items-center gap-2">
                    <i class="fas fa-exclamation-triangle text-3xl text-yellow-500"></i>
                    <p>No se encontró información.</p>
                </div>
            @endif
        </div>
    </div>
</div>
