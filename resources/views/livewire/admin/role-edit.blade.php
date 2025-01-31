<x-modal form-action="edit">
    {{ csrf_field() }}
    <x-slot name="title">
        Edit Role
    </x-slot>

    <x-slot name="content">
        <div class="px-4 py-3 mb-8 bg-white rounded-lg">
            <label class="block text-sm">
                <span class="text-gray-700">
                    Name
                </span>
                <input type="text" wire:model.defer="name" class="block w-full mt-1 text-sm border-none appearance-none p-2 focus:shadow-outline-blue focus:outline-none form-input" placeholder="Name" disabled>
                @error('name')
                    <span class="text-xs text-red-600 dark:text-red-400">
                        {{ $message }}
                    </span>
                @enderror
            </label>

            <label class="block mt-4 text-sm">
                <span class="text-gray-700">
                    Role
                </span>
            <select wire:model="role_id" class="block w-full mt-1 text-sm border rounded appearance-none form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple" required>
                <option value="{{ $this->role_user }}" selected>{{ $this->role_user }}</option>
                @foreach($roles as $role)
                    @if($role->name == $this->role_user)

                    @elseif($role->name == 'super-admin')
                    {{-- DO NOT INCLUDE SUPER ADMIN IN SELECTION --}}
                    @else
                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                    @endif
                @endforeach
            </select>
            @error('role_id')
                    <span class="text-xs text-red-600 dark:text-red-400">
                        {{ $message }}
                    </span>
                @enderror
            </label>
            {{--
                <!-- Valid input -->
            <label class="block mt-4 text-sm">
                <span class="text-gray-700">
                    Category
                </span>
                <select wire:model="category_id" class="block w-full mt-1 text-sm border rounded appearance-none form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple" required>
                    <option value="" selected>--choose category--</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                <span class="text-xs text-red-600 dark:text-red-400">
                    {{ $message }}
                </span>
            @enderror
            </label>

            <label class="block mt-4 text-sm">
                <span class="text-gray-700">
                    Brand
                </span>
                <select wire:model="brand_id" class="block w-full mt-1 text-sm border rounded appearance-none form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple" required>
                    <option value="" selected>--choose brand--</option>
                    @foreach($brands as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                    @endforeach
                </select>
                @error('brand_id')
                <span class="text-xs text-red-600 dark:text-red-400">
                    {{ $message }}
                </span>
            @enderror
            </label>

            <label class="block mt-4 text-sm">
                <span class="text-gray-700">
                    Description
                </span>
                <textarea type="text" wire:model.defer="description" class="block w-full mt-1 text-sm border rounded appearance-none p-2 focus:shadow-outline-blue focus:outline-none form-input" placeholder="Description" required>
                </textarea>
                @error('description')
                    <span class="text-xs text-red-600 dark:text-red-400">
                        {{ $message }}
                    </span>
                @enderror
            </label>

            <label class="block mt-4 text-sm">
                <span class="text-gray-700">
                    Selling Price
                </span>
                <input type="number" wire:model.defer="selling_price" class="block w-full mt-1 text-sm border rounded appearance-none p-2 focus:shadow-outline-blue focus:outline-none form-input" placeholder="Selling Price" required>
                @error('selling_price')
                    <span class="text-xs text-red-600 dark:text-red-400">
                        {{ $message }}
                    </span>
                @enderror
            </label>

            <label class="block mt-4 text-sm">
                <span class="text-gray-700">
                    Quantity
                </span>
                <input type="number" wire:model.defer="quantity" class="block w-full mt-1 text-sm border rounded appearance-none p-2 focus:shadow-outline-blue focus:outline-none form-input" placeholder="Quantity" required>
                @error('Quantity')
                    <span class="text-xs text-red-600 dark:text-red-400">
                        {{ $message }}
                    </span>
                @enderror
            </label>

            <label class="block mt-4 text-sm">
                <span class="text-gray-700">
                    Image
                </span><br><br>
                <a onclick='Livewire.emit("openModal", "admin.edit-product-image", {{ json_encode(["id" => $this->product_id ]) }})' class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    Replace image
                </a>
            </label>
            --}}

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