<div
    x-data="{ open: @entangle('showModal').defer }"
    x-show="open"
    class="fixed inset-0 flex items-center justify-center z-50"
>
    <!-- Fondo oscuro -->
    <div class="absolute inset-0 bg-black bg-opacity-50" @click="open = false"></div>

    <!-- Modal grande y espacioso -->
    <div class="bg-white rounded-2xl shadow-2xl p-8 z-50 max-w-2xl w-full relative">
        <h2 class="text-2xl font-bold mb-6 text-gray-800 flex items-center gap-2">
            <!-- Icono -->
            <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                <path d="M19 21H5a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h4l2-2h6a2 2 0 0 1 2 2z"/>
            </svg>
            Selecciona las etiquetas
        </h2>

        <div class="flex flex-wrap gap-3 max-h-72 overflow-y-auto pb-2">
            @foreach($tags as $tag)
                <label class="relative cursor-pointer">
                    <!-- Checkbox oculto -->
                    <input type="checkbox"
                           value="{{ $tag->id }}"
                           wire:model="selectedTags"
                           class="hidden peer">

                    <!-- Chip grande con icono -->
                    <span
                        class="flex items-center gap-2 px-4 py-2 rounded-full text-base font-medium
                               transition border border-gray-300 peer-checked:ring-2 peer-checked:ring-offset-2
                               peer-checked:ring-blue-400"
                        style="background-color: {{ $tag->color }}; color: white;"
                    >
                        <!-- Icono etiqueta (ejemplo usando Lucide/heroicons, puedes cambiarlo) -->
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2"
                             viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 12H4"/>
                        </svg>
                        {{ $tag->name }}
                    </span>
                </label>
            @endforeach
        </div>

        <div class="flex justify-end gap-4 mt-8">
            <button
                @click="open = false"
                class="px-5 py-3 text-base font-semibold text-gray-700 bg-gray-300 rounded hover:bg-gray-400 transition"
            >
                Cancelar
            </button>

            <button
                wire:click="save"
                class="px-5 py-3 text-base font-semibold text-white bg-gray-700 rounded hover:bg-gray-500 transition"
            >
                <svg class="w-5 h-5 inline-block mr-1" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 13l4 4L19 7"/>
                </svg>
                Aceptar
            </button>
        </div>
    </div>
</div>
