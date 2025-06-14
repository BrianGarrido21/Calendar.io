<div
    x-data="{ open: @entangle('showModal').defer }"
    x-show="open"
    class="fixed inset-0 flex items-center justify-center z-50"
>
    <!-- Fondo oscuro -->
    <div class="absolute inset-0 bg-black bg-opacity-50" @click="open = false"></div>

    <!-- Modal -->
    <div class="bg-white rounded-lg shadow-xl p-6 z-50 max-w-md w-full">
        <h2 class="text-xl font-bold mb-4">¿Eliminar Evento?</h2>
        <p class="text-gray-700 mb-6">¿Estás seguro de que deseas eliminar este evento? Esta acción no se puede deshacer.</p>

        <div class="flex justify-end gap-2">
            <button
                class="px-4 py-2 text-sm bg-gray-300 rounded hover:bg-gray-400"
                @click="open = false"
            >
                Cancelar
            </button>
            <button
                wire:click="deleteEvent"
                class="px-4 py-2 text-sm bg-red-500 text-white rounded hover:bg-red-600"
            >
                Eliminar
            </button>
        </div>
    </div>
</div>
