<x-modal>
    <x-slot name="title">
        Activity Log Details
    </x-slot>
    <x-slot name="content">
        <div class="px-4 py-3 mb-8 bg-white rounded-lg">
            @if(!str_contains($this->activity->description, 'Deleted'))
            Data:<br>
                @foreach ($this->activity->properties['old'][0] as $key=>$item)
                    <b>{{ $key }}:</b> {{ $item}}<br>
                    
                @endforeach
                <br><br>
            @endif
            
            @if(str_contains($this->activity->description, 'Updated') || str_contains($this->activity->description, 'Deleted'))   
            
                @if(str_contains($this->activity->description, 'Updated'))
                Updated data:
                @elseif(str_contains($this->activity->description, 'Deleted'))
                Deleted data:
                @endif<br>
                @foreach ($this->activity->properties['attributes'][0] as $key=>$item)
                    <b>{{ $key }}:</b> {{ $item }}<br>
                @endforeach
                

            @endif
        </div>
    </x-slot>

    <x-slot name="buttons">
        <button wire:click.prevent="$emit('closeModal')" class="w-full px-5 py-3 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray">
            Close
        </button>
    </x-slot>
</x-modal>