<div 
    x-data="{ open: @entangle('show') }"
    x-show="open"
    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
    x-cloak
>
    <div class="bg-white rounded-lg shadow-lg w-full max-w-2xl p-6 relative">
        <h2 class="text-2xl font-semibold mb-4">Crear Evento</h2>

        @if (session()->has('success'))
            <div class="bg-green-200 text-green-800 p-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form wire:submit.prevent="createEvent">
            <!-- Descripción -->
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Descripción</label>
                <input type="text" id="description" wire:model.defer="description"
                       class="mt-1 block w-full border border-gray-300 rounded-md p-2 shadow-sm">
                @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Ubicación -->
            <div class="mb-4">
                <label for="location" class="block text-sm font-medium text-gray-700">Ubicación (opcional)</label>
                <input type="text" id="location" wire:model.defer="location"
                       class="mt-1 block w-full border border-gray-300 rounded-md p-2 shadow-sm">
                @error('location') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Estado -->
            <div class="mb-4">
                <label for="status_id" class="block text-sm font-medium text-gray-700">Estado</label>
                <select id="status_id" wire:model.defer="status_id"
                        class="mt-1 block w-full border border-gray-300 rounded-md p-2 shadow-sm">
                    <option value="">Selecciona un estado</option>
                    @foreach ($statuses as $status)
                        <option value="{{ $status->id }}">{{ $status->name }}</option>
                    @endforeach
                </select>
                @error('status_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>


            <!-- Botones -->
            <div class="flex justify-end gap-2">
                <button type="button" @click="open = false"
                        class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                    Cancelar
                </button>
                <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Guardar
                </button>
            </div>
        </form>
    </div>
</div>
