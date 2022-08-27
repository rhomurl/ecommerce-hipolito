<x-modal form-action="edit">
    {{ csrf_field() }}
    <x-slot name="title">
        Edit Stock
    </x-slot>

    <x-slot name="content">
        <div class="px-4 py-3 mb-8 bg-white rounded-lg">
            <label class="block text-sm">
                <span class="text-gray-700">
                    Product Name
                </span>
                <input type="text" wire:model="name" class="block w-full mt-1 text-sm border rounded appearance-none p-2 focus:shadow-outline-blue focus:outline-none form-input" disabled>
                {{-- @error('name')
                    <span class="text-xs text-red-600 dark:text-red-400">
                        {{ $message }}
                    </span>
                @enderror --}}
            </label>


            <label class="block mt-4 text-sm">
                <span class="text-gray-700">
                    Action
                </span>
                <select wire:model="action" class="block w-full mt-1 text-sm border rounded appearance-none p-2 focus:shadow-outline-blue focus:outline-none form-input" required>
                    <option value="" selected>--select action--</option>
                    <option value="add" selected>Add quantity</option>
                    <option value="remove" selected>Remove quantity</option>
                </select>
                @error('')
                <span class="text-xs text-red-600 dark:text-red-400">
                    {{ $message }}
                </span>
            @enderror
            </label>

            <label class="block mt-4 text-sm">
                <span class="text-gray-700">
                    Current Quantity
                </span>
                <input type="text" wire:model="myquantity" class="block w-full mt-1 text-sm border rounded appearance-none p-2 focus:shadow-outline-blue focus:outline-none form-input" disabled>
                {{-- @error('name')
                    <span class="text-xs text-red-600 dark:text-red-400">
                        {{ $message }}
                    </span>
                @enderror --}}
            </label>
            
            <!-- Invalid input -->
            <label class="block mt-4 text-sm">
                <span class="text-gray-700">
                    Quantity
                </span>
                <input type="number" wire:model="quantity" class="block w-full mt-1 text-sm border rounded appearance-none p-2 focus:shadow-outline-blue focus:outline-none form-input" placeholder="Quantity" required>
                @error('quantity')
                    <span class="text-xs text-red-600 dark:text-red-400">
                        {{ $message }}
                    </span>
                @enderror

                <span class="text-xs text-red-600 dark:text-red-400">
                {{ $this->err_message }}
                </span>
            </label>

            <label class="block mt-4 text-sm">
                <span class="text-gray-700">
                    Updated Quantity
                </span>
                <input type="text" wire:model="updated_quantity" class="block w-full mt-1 text-sm border rounded appearance-none p-2 focus:shadow-outline-blue focus:outline-none form-input" disabled>
                @error('updated_quantity')
                    <span class="text-xs text-red-600 dark:text-red-400">
                        {{ $message }}
                    </span>
                @enderror
            </label>

            @if($action == 'remove')
                <label class="block mt-4 text-sm">
                    <span class="text-gray-700">
                        Remark
                    </span>
                    <select wire:model="remark" class="block w-full mt-1 text-sm border rounded appearance-none p-2 focus:shadow-outline-blue focus:outline-none form-input" required>
                        <option value="" selected>--select remark--</option>
                        <option value="adjust" selected>Adjustment</option>
                        <option value="waste" selected>Stock Waste/Damage</option>
                        <option value="lost_stock" selected>Lost Stock (missing)</option>
                        <option value="personal" selected>Personal use</option>
                    </select>
                    @error('remark')
                    <span class="text-xs text-red-600 dark:text-red-400">
                        {{ $message }}
                    </span>
                @enderror
                </label>
            @endif



        </div>
    </x-slot>

    <x-slot name="buttons">
        <button wire:click.prevent="$emit('closeModal')" class="w-full px-5 py-3 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray">
            Cancel
        </button>
        <button class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
            Submit
        </button>

        
    </x-slot>
</x-modal>