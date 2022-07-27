<x-modal form-action="edit">
    {{ csrf_field() }}
    <x-slot name="title">
        Edit Product Inventory
    </x-slot>

    <x-slot name="content">
        <div class="px-4 py-3 mb-8 bg-white rounded-lg">
            <label class="block text-sm">
                <span class="text-gray-700">
                    Name
                </span>
                <input wire:model="product_name" type="text"  class="block bg-gray-100 w-full mt-1 text-sm border rounded appearance-none p-2 focus:shadow-outline-blue focus:outline-none form-input" placeholder="Product name" disabled>
            </label>

            <label class="block mt-4 text-sm">
                <span class="text-gray-700">
                    Supplier
                </span>
                <input wire:model="supplier" type="text"  class="block w-full mt-1 text-sm border rounded appearance-none p-2 focus:shadow-outline-blue focus:outline-none form-input" placeholder="Supplier" required>
                @error('supplier')
                    <span class="text-xs text-red-600 dark:text-red-400">
                        {{ $message }}
                    </span>
                @enderror
            </label>

            <label class="block mt-4 text-sm">
                <span class="text-gray-700">
                    Product Cost
                </span>
                <input wire:model="product_cost" type="text" class="block w-full mt-1 text-sm border rounded appearance-none p-2 focus:shadow-outline-blue focus:outline-none form-input" placeholder="Product cost" required>
                @error('product_cost')
                    <span class="text-xs text-red-600 dark:text-red-400">
                        {{ $message }}
                    </span>
                @enderror
            </label>

            <label class="block mt-4 text-sm">
                <span class="text-gray-700">
                    Starting Stock
                </span>
                <input wire:model="starting_stock" type="text" class="block bg-gray-100 w-full mt-1 text-sm border rounded appearance-none p-2 focus:shadow-outline-blue focus:outline-none form-input" placeholder="Starting stock" disabled>
            </label>

            <label class="block mt-4 text-sm">
                <span class="text-gray-700">
                    Current Stock
                </span>
                <input wire:model="quantity" type="text" class="block bg-gray-100 w-full mt-1 text-sm border rounded appearance-none p-2 focus:shadow-outline-blue focus:outline-none form-input" placeholder="Starting stock" disabled>
                <p class="text-xs text-gray-600 dark:text-gray-400">
                    Quantity/stock can be change in <a href="{{ route('admin.products') }}" class="border-1">Product</a> page.
                </p>
            </label>

            <label class="block mt-4 text-sm">
                <span class="text-gray-700">
                    Reorder Level
                </span>
                <input wire:model="reorder_level" type="text" class="block w-full mt-1 text-sm border rounded appearance-none p-2 focus:shadow-outline-blue focus:outline-none form-input" placeholder="Reorder level" required>
                @error('reorder_level')
                    <span class="text-xs text-red-600 dark:text-red-400">
                        {{ $message }}
                    </span>
                @enderror
            </label>

            <label class="block mt-4 text-sm">
                <span class="text-gray-700">
                    Date Received
                </span>
                <input wire:model="received_at" type="date" min="2000-01-01" max="{{ now()->toDateString() }}" class="block w-full mt-1 text-sm border rounded appearance-none p-2 focus:shadow-outline-blue focus:outline-none form-input" required>
                <p class="text-xs text-gray-600 dark:text-gray-400">
                    dd/mm/yyyy
                </p>
                @error('received_at')
                    <span class="text-xs text-red-600 dark:text-red-400">
                        {{ $message }}
                    </span>
                @enderror
            </label>
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