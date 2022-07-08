<x-modal form-action="create">
    {{ csrf_field() }}
    <x-slot name="title">
        Create Product (Step 1)
    </x-slot>

    <x-slot name="content">
        <div class="px-4 py-3 mb-8 bg-white rounded-lg">
            <label class="block text-sm">
                <span class="text-gray-700">
                    Product Name
                </span>
                <input type="text" wire:model="name" class="block w-full mt-1 text-sm border rounded appearance-none p-2 focus:shadow-outline-blue focus:outline-none form-input" placeholder="Name" required>
                @error('name')
                    <span class="text-xs text-red-600 dark:text-red-400">
                        {{ $message }}
                    </span>
                @enderror
            </label>

            <label class="block mt-4 text-sm">
                <span class="text-gray-700">
                    Supplier
                </span>
                <input type="text" wire:model="input.supplier" class="block w-full mt-1 text-sm border rounded appearance-none p-2 focus:shadow-outline-blue focus:outline-none form-input" placeholder="Supplier name" required>
                @error('input.supplier')
                    <span class="text-xs text-red-600 dark:text-red-400">
                        {{ $message }}
                    </span>
                @enderror
            </label>

            <!-- Valid input -->
            <label class="block mt-4 text-sm">
                <span class="text-gray-700">
                    Category
                </span>
                <select wire:model="input.category_id" class="block w-full mt-1 text-sm border rounded appearance-none form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple" required>
                    <option value="" selected>{{ '--select category--' }}</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('input.category_id')
                <span class="text-xs text-red-600 dark:text-red-400">
                    {{ $message }}
                </span>
            @enderror
            </label>

            <label class="block mt-4 text-sm">
                <span class="text-gray-700">
                    Brand
                </span>
                <select wire:model="input.brand_id" class="block w-full mt-1 text-sm border rounded appearance-none form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple" required>
                    <option value="" selected>{{ '--choose brand--' }}</option>
                    @foreach($brands as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                    @endforeach
                </select>
                @error('input.brand_id')
                <span class="text-xs text-red-600 dark:text-red-400">
                    {{ $message }}
                </span>
            @enderror
            </label>

            <label class="block mt-4 text-sm">
                <span class="text-gray-700">
                    Date Received
                </span>
                <input type="date" wire:model.defer="input.received_date" min="2000-01-01" max="{{ now()->toDateString() }}" class="block w-full mt-1 text-sm border rounded appearance-none p-2 focus:shadow-outline-blue focus:outline-none form-input" placeholder="Description" required>
                <p class="text-xs text-gray-600 dark:text-gray-400">
                    dd/mm/yyyy
                </p>
                @error('input.received_date')
                    <span class="text-xs text-red-600 dark:text-red-400">
                        {{ $message }}
                    </span>
                @enderror
            </label>

            <label class="block mt-4 text-sm">
                <span class="text-gray-700">
                    Description
                </span>
                <textarea type="text" wire:model.defer="input.description" class="block w-full mt-1 text-sm border rounded appearance-none p-2 focus:shadow-outline-blue focus:outline-none form-input" placeholder="Description" required>
                </textarea>
                @error('input.description')
                    <span class="text-xs text-red-600 dark:text-red-400">
                        {{ $message }}
                    </span>
                @enderror
            </label>
        </div>
    </x-slot>

    <x-slot name="buttons">
        <button wire:click="closeM" class="w-full px-5 py-3 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray">
            Cancel
        </button>
        <button class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
            Submit
        </button>
    </x-slot>
</x-modal>



