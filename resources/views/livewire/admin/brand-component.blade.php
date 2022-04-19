@section('title', 'Brands')

<div class="container grid px-6 mx-auto">
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        @yield('title')
    </h2>

    <div class="px-3 my-6">  
        <button onclick="Livewire.emit('openModal', 'admin.brand-modal')"  class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
            Create Brand
            <span class="ml-2" aria-hidden="true">+</span>
        </button>
        {{--@if($isOpen)
            @include('livewire.admin.create_brand')
        @endif --}}
    </div>
    <div class="w-full overflow-hidden rounded-lg shadow-xs border border-gray-200 dark:border-gray-700">
        <div class="w-full overflow-x-auto">
            
        <div class="ml-5 mt-4 mb-5">
            <input wire:model="search" type="text" placeholder="Search brand" class="px-2 py-2 text-sm text-black transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-100 focus:border-gray-500 focus:bg-white focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 " autofocus/>
        </div>
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3">Name</th>
                        <th class="px-4 py-3">Slug</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    
                    @forelse($brands as $brand)
                        <tr class="text-gray-700 dark:text-gray-400">
                            <td class="px-4 py-3">
                                <div class="flex items-center text-sm">
                                    <!-- Avatar with inset shadow -->
                                    <div>
                                        <p class="font-semibold">{{ $brand->name }}</p>
                                        <p class="text-xs text-gray-600 dark:text-gray-400">
                                            {{ $brand->product->count() }}
                                            {{ $brand->product->count() == '1' ? 'product': 'products' }} 
                                        </p>
                                    </div>
                                </div>
                            </td>
                            
                            <td class="px-4 py-3">
                                <div class="flex items-center text-sm">
                                    <!-- Avatar with inset shadow -->
                                    <div>
                                        <p class="font-semibold">{{ $brand->slug }}</p>
                                    </div>
                                </div>
                            </td>
                            
                            
                            <td class="px-4 py-3">
                                <div class="flex items-center space-x-4 text-sm">
                                    <button onclick='Livewire.emit("openModal", "admin.brand-edit", {{ json_encode(["id" => $brand->id]) }})' class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 hover:bg-gray-200 focus:outline-none focus:shadow-outline-gray" aria-label="Edit">
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                        </svg>
                                    </button>

                                    <div x-data="{ confirmDelete:false }" class="flex flex-wrap -mx-2 overflow-hidden">
                                        <button x-show="!confirmDelete" x-on:click="confirmDelete=true" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 hover:bg-gray-200 focus:outline-none focus:shadow-outline-gray">
                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                            </svg>
                                        </button>
                                        <div class="my-2 px-2 w-1/2 overflow-hidden">
                                            <button x-show="confirmDelete" x-on:click="confirmDelete=false"  wire:click="confirmDelete({{ $brand->id }})" class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-green-600 hover:bg-green-700 focus:outline-none focus:shadow-outline-green">Yes</button>
                                        </div>
                                      
                                        <div class="my-2 px-2 w-1/2 overflow-hidden">
                                            <button x-show="confirmDelete" x-on:click="confirmDelete=false" class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">No</button>   
                                        </div>
                                      </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr class="text-gray-700 dark:text-gray-400">
                            <td class="w-full px-4 py-3">No results</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $brands->links('vendor.pagination.default')}}
            </div>
    </div>
</div>