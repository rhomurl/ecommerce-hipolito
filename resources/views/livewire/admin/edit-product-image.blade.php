<x-modal form-action="create">
    {{ csrf_field() }}
    <x-slot name="title">
        Upload New Image
    </x-slot>

    <x-slot name="content">
        <div class="px-4 py-3 mb-8 bg-white rounded-lg">
            <!-- Invalid input -->
            @if($this->image)
                <img src="{{ asset('storage/') }}/{{ $this->image }}" height="50" width="50"/>
            @endif
            <label class="block mt-4 text-sm">
                <span class="text-gray-700">
                    Image
                </span><br>
                <input wire:model="image" type="file" name="image" required>
                @error('image')
                    <span class="text-xs text-red-600 dark:text-red-400">
                        {{ $message }}
                    </span>
                @enderror
            </label>
        </div>
    </x-slot>

    <x-slot name="buttons">
        <button wire:click="$emit('closeModal')" class="w-full px-5 py-3 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray">
            Back
        </button>
        <button class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
            Submit
        </button>

        
    </x-slot>
</x-modal>