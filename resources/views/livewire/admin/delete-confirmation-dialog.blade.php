
<x-modal>
    {{ csrf_field() }}
    <x-slot name="title">
        Confirm Delete
    </x-slot>

    <x-slot name="content">
        <div class="text-center text-3xl text-gray-700">
            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto mb-4 w-20 h-20 text-red-400 dark:text-red-200" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
              </svg>
            Are you sure?
        </div>
                <div class="text-center font-light text-gray-700 mb-8">
                    Do you really want to delete this record?<br>This process cannot be undone.
                </div>
                <div class="flex justify-center">
                    <button wire:click="$emit('closeModal')"
                        class="bg-gray-300 text-gray-900 rounded hover:bg-gray-200 px-6 py-2 focus:outline-none mx-1">Cancel</button>
                    <button wire:click.prevent="confirmDelete({{ $this->id }})"
                        class="bg-red-500 text-gray-200 rounded hover:bg-red-400 px-6 py-2 focus:outline-none mx-1">Delete</button>
                </div>
    </x-slot>

    <x-slot name="buttons">
        {{--<button wire:click="$emit('closeModal')" class="w-full px-5 py-3 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray">
            Cancel
        </button>
        <button class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
            Submit
        </button>--}}

        
    </x-slot>
</x-modal>