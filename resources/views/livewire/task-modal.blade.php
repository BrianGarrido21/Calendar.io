<div x-data="{ open: @entangle('modalVisible') }">
    <!-- Fondo oscuro -->
    <div x-show="open" class="fixed inset-0 bg-black bg-opacity-50 z-40" @click="open = false"></div>

    <!-- Modal -->
    <div x-show="open" x-transition class="fixed z-50 inset-0 flex items-center justify-center p-4 overflow-y-auto">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-5xl p-10 relative space-y-6"> <!-- Más grande -->

            <!-- Botón cerrar -->
            <button @click="open = false"
                class="absolute top-4 right-4 text-gray-700 hover:text-red-500 text-3xl font-bold transition">
                <i class="fas fa-times"></i>
            </button>

            @if ($task)
                <div class="flex items-center gap-4 mb-6">
                    <i class="fas fa-tasks text-gray-700 text-4xl"></i>
                    <h2 class="text-4xl font-bold text-gray-800">Detalles de la Tarea</h2>
                </div>

                <div class="space-y-3 text-gray-700 text-lg">
                    <p class="flex items-center gap-3">
                        <i class="fas fa-heading text-gray-700"></i>
                        <strong>Título:</strong> {{ $task->title }}
                    </p>
                    <p class="flex items-center gap-3">
                        <i class="fas fa-align-left text-gray-700"></i>
                        <strong>Descripción:</strong> {{ $task->description ?? 'Sin descripción' }}
                    </p>
                    <p class="flex items-center gap-3">
                        <i class="fas fa-calendar-alt text-gray-700"></i>
                        <strong>Vencimiento:</strong> {{ \Carbon\Carbon::parse($task->due_date)->format('d/m/Y H:i') }}
                    </p>
                    <p class="flex items-center gap-3">
                        <i class="fas fa-calendar text-gray-700"></i>
                        <strong>Evento:</strong> {{ $task->event->description ?? 'Sin evento' }}
                    </p>

                    @if ($task->status)
                        <div class="flex items-center gap-3">
                            <i class="fas fa-check-circle text-gray-700"></i>
                            <strong>Status:</strong>
                            <span class="px-3 py-1 rounded-full text-white text-sm"
                                style="background-color: {{ $task->status->color ?? '#666' }}">
                                {{ $task->status->name }}
                            </span>
                        </div>
                    @else
                        <p class="flex items-center gap-3">
                            <i class="fas fa-check-circle text-gray-700"></i>
                            <strong>Status:</strong> Sin status
                        </p>
                    @endif
                </div>

                <div class="mt-8 flex justify-end gap-3">
                    <a href="{{ route('tasks.show', $task) }}"
                        class="flex items-center gap-2 bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-500 transition text-lg">
                        <i class="fas fa-cogs"></i> Gestionar Tarea
                    </a>
                </div>
            @else
                <div class="text-center text-gray-500 flex flex-col items-center gap-4">
                    <i class="fas fa-exclamation-triangle text-4xl text-yellow-500"></i>
                    <p class="text-lg">No se encontró la tarea.</p>
                </div>
            @endif
        </div>
    </div>
</div>
