<x-modal>
    <x-slot name="title">
        Failed
    </x-slot>

    <x-slot name="content">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="red">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
          </svg>
        {{ $message }}
    </x-slot>

    <x-slot name="buttons">
        <button wire:click="fClose()" class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">OK</button>
        {{--<button wire:click="$emit('closeModal', true)">Force Close Modal</button>--}}
    </x-slot>
</x-modal>