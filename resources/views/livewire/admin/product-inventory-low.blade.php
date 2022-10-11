@section('title', 'Product Inventory')

<div class="container grid px-6 mx-auto">
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        @yield('title')
    </h2>

    @if($inventories)
        <div class="px-3 my-6">  
            <button wire:click.prevent="exportCsv"  class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple {{ $inventories->count() == 0 ? 'hidden': ''}}">
            Export to CSV
            </button>
        </div>
    @endif

    <div class="w-full overflow-hidden rounded-lg shadow-xs border border-gray-200 dark:border-gray-700">
        <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400">
            <li class="mr-2">
                <a href="{{ route('admin.product-inventory') }}" aria-current="page" class="inline-block p-4 hover:text-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 dark:hover:text-gray-300">All ({{  $this->all_count }})</a>
            </li>
            <li class="mr-2">
                <a href="{{ route('admin.product-inventory-low') }}" class="inline-block p-4 rounded-t-lg text-blue-600 bg-gray-100 active border-b-2 border-blue-600 dark:bg-gray-800 dark:text-blue-500">Low Stock ({{ $this->low_count }})</a>
            </li>
        </ul>
        <div class="w-full overflow-x-auto">
            
            <div class="flex flex-wrap overflow-hidden">

                <div class="w-full overflow-hidden xl:w-1/5">
                    <div class="ml-5 mt-4 mb-5">
                    <input wire:model="search" type="text" placeholder="Search inventory" class="px-2 py-2 text-sm text-black transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-100 focus:border-gray-500 focus:bg-white focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 " autofocus/>
                    </div>
                </div>

                <div class="w-full overflow-hidden xl:w-1/5">
                    <!-- Column Content -->
                </div>

                <div class="w-full overflow-hidden xl:w-1/5">
                    <!-- Column Content -->
                </div>

                <div class="w-full overflow-hidden xl:w-1/5">
                    <!-- Column Content -->
                </div>

                <div class="w-full overflow-hidden xl:w-1/5">
                    <div class="ml-5 mt-4 mb-5">
                <select wire:model="paginate" class="mt-1 text-sm border rounded appearance-none dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select> <span class="text-sm dark:text-gray-300">inventory per page</span>
            </div>
                </div>

            </div>
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3">Product Name</th>
                        <th wire:click="sortByColumn('supplier')" class="px-4 py-3">Supplier
                            @if ($sortColumn == 'supplier')
                                <i class="fa fa-fw fa-sort-{{ $sortDirection }}"></i>
                            @else
                                <i class="fa fa-fw fa-sort" style="color:#DCDCDC"></i>
                            @endif
                        </th>
                        <th wire:click="sortByColumn('product_cost')" class="px-4 py-3">Product Cost
                            @if ($sortColumn == 'product_cost')
                                <i class="fa fa-fw fa-sort-{{ $sortDirection }}"></i>
                            @else
                                <i class="fa fa-fw fa-sort" style="color:#DCDCDC"></i>
                            @endif
                        </th>

                        <th wire:click="sortByColumn('starting_stock')" class="px-4 py-3">Starting Stock
                            @if ($sortColumn == 'starting_stock')
                                <i class="fa fa-fw fa-sort-{{ $sortDirection }}"></i>
                            @else
                                <i class="fa fa-fw fa-sort" style="color:#DCDCDC"></i>
                            @endif
                        </th>

                        <th class="px-4 py-3">Current Stock</th>

                        <th wire:click="sortByColumn('reorder_level')" class="px-4 py-3">Reorder Level
                            @if ($sortColumn == 'reorder_level')
                                <i class="fa fa-fw fa-sort-{{ $sortDirection }}"></i>
                            @else
                                <i class="fa fa-fw fa-sort" style="color:#DCDCDC"></i>
                            @endif
                        </th>

                        <th wire:click="sortByColumn('created_at')" class="px-4 py-3">Created At
                            @if ($sortColumn == 'created_at')
                                <i class="fa fa-fw fa-sort-{{ $sortDirection }}"></i>
                            @else
                                <i class="fa fa-fw fa-sort" style="color:#DCDCDC"></i>
                            @endif
                        </th>

                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    
                    @forelse($inventories as $inventory)
                       
                        <tr class="text-gray-700 dark:text-gray-400">
                            <td class="px-4 py-3">
                                <div class="flex items-center text-sm">
                                    <div>
                                        <p class="font-semibold">{{ $inventory->product->name }}</p>
                                       
                                    </div>
                                </div>
                            </td>

                            <td class="px-4 py-3">
                                <div class="flex items-center text-sm">
                                    <div>
                                        <p class="font-semibold">{{ $inventory->supplier }}</p>
                                    </div>
                                </div>
                            </td>
                            
                            <td class="px-4 py-3">
                                <div class="flex items-center text-sm">
                                    <div>
                                        <p class="font-semibold">₱ {{ $inventory->product_cost }}</p>
                                    </div>
                                </div>
                            </td>

                            <td class="px-4 py-3">
                                <div class="flex items-center text-sm">
                                    <div>
                                        <p class="font-semibold">{{ $inventory->starting_stock }}</p>
                                    </div>
                                </div>
                            </td>

                            <td class="px-4 py-3">
                                <div class="flex items-center text-sm">
                                    <div>
                                        <p class="font-semibold">{{ $inventory->product->quantity }}</p>
                                    </div>
                                </div>
                            </td>

                            <td class="px-4 py-3">
                                <div class="flex items-center text-sm">
                                    <div>
                                        <p class="font-semibold">{{ $inventory->reorder_level }}</p>
                                    </div>
                                </div>
                            </td>
                            
                            <td class="px-4 py-3">
                                <div class="flex items-center text-sm">
                                    <div>
                                        <p class="font-semibold">{{ \Carbon\Carbon::parse($inventory->created_at)->format('F j, Y') }}</p>
                                        {{-- format('l, F j Y')--}}
                                    </div>
                                </div>
                            </td>

                            <td class="px-4 py-3">
                                <div class="flex items-center text-sm">
                                    <div>
                                        <p class="font-semibold">
                                            @if($inventory->reorder_level >= $inventory->product->quantity )
                                            <span class="px-2 py-1 font-semibold leading-tight text-orange-700 bg-orange-100 rounded-full dark:text-white dark:bg-orange-600">
                                                REORDER
                                            </span>
                                            @else
                                            <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                                ACTIVE
                                            </span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </td>
                            
                            <td class="px-4 py-3">
                                <div class="flex items-center space-x-4 text-sm">
                                    <button wire:click.prevent="edit({{ $inventory->id }})" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 hover:bg-gray-200 focus:outline-none focus:shadow-outline-gray" aria-label="Edit">
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                        </svg>
                                    </button>

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr class="text-gray-700 dark:text-gray-400">
                            <td colspan="9" class="w-full px-4 py-3">No results</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            @if($inventories)
                {{ $inventories->links('livewire.pagination.defaultadmin')}}
            @endif
            </div>
    </div>
</div>