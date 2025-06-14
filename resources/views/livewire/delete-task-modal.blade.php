<div
    x-data="{ open: @entangle('showModal').defer }"
    x-show="open"
    class="fixed inset-0 flex items-center justify-center z-50"
>
    <!-- Fondo oscuro -->
    <div class="absolute inset-0 bg-black bg-opacity-50" @click="open = false"></div>

    <!-- Modal -->
    <div class="bg-white rounded-lg shadow-xl p-6 z-50 max-w-md w-full">
        <h2 class="text-xl font-bold mb-4 text-gray-800">¿Eliminar Tarea?</h2>
        <p class="text-gray-600 mb-6">
            ¿Estás seguro de que deseas eliminar esta tarea? Esta acción no se puede deshacer.
        </p>

        <div class="flex justify-end gap-3">
            <!-- Botón cancelar -->
            <button
                @click="open = false"
                class="px-4 py-2 text-sm font-semibold text-gray-700 bg-gray-300 rounded hover:bg-gray-400 transition"
            >
                Cancelar
            </button>

            <!-- Botón eliminar -->
            <button
                wire:click="deleteTask"
                class="px-4 py-2 text-sm font-semibold text-white bg-red-500 rounded hover:bg-red-600 transition"
            >
                Eliminar
            </button>
        </div>
    </div>
</div>
