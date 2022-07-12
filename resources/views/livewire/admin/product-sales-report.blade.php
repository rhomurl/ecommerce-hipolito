@section('title', 'Product Sales Report')

<div class="container px-6 mx-auto grid">
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        @yield('title')
    </h2>
    <div>
        <button wire:click.prevent="redirectTo('admin.reports')" class="flex items-center justify-between mb-3 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
              </svg>
            <span>Go to Report Management</span>
        </button>
        <div class="flex flex-col flex-wrap mb-4 space-y-4 md:flex-row md:items-end md:space-x-4">
            <button wire:click.prevent="generatePDF" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
            <span>Export to PDF</span>
            </button>
            <button wire:click.prevent="exportCsv" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                <span>Export to CSV</span>
            </button>
        </div>
    </div>

    <div class="w-full overflow-hidden rounded-lg shadow-xs border border-gray-200 dark:border-gray-700">
        <div class="w-full overflow-x-auto">
            
            <table class="w-full whitespace-no-wrap">

                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left uppercase border-b dark:border-gray-700  dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3 text-left">
                            {{--@if($this->date_from && $this->date_to)
                                Results from {{ \Carbon\Carbon::parse($this->date_from)->format('F j, Y') }} to {{ \Carbon\Carbon::parse($this->date_to)->format('F j, Y') }}

                            @elseif($this->year_from && $this->month_from && $this->year_to && $this->month_to)
                                Results from {{ date('M', strtotime('2022-'.$this->month_from.'-01')) }} {{ $this->year_from}} to {{ date('M', strtotime('2022-'.$this->month_to.'-01')) }} {{ $this->year_to}}

                            @elseif($this->year_from && $this->month_from)
                                Results from Year {{ date('M', strtotime('2022-'.$this->month_from.'-01')) }} {{ $this->year_from}}

                            @elseif($this->year_from && $this->year_to)
                                Results from Year {{ $this->year_from }} to {{ $this->year_to }}

                            @elseif($this->year_from)
                                Results from Year {{ $this->year_from }}

                            
                            @endif--}}

                            
                        </th>
                        <th class="px-4 py-3">
                           {{--<select class="block w-full mt-1 text-sm border rounded appearance-none dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                            <option>This Month</option>
                            <option>Last Month</option>
                            <option>This Year</option>
                            <option>All</option>
                            </select--}}
                        </th>
                        <th class="px-4 py-3"></th>
                        <th class="px-4 py-3"></th>
                       
                    </tr>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3">Product Name</th>
                        <th class="px-4 py-3">Products Sold</th>
                        <th class="px-4 py-3">Current Stock</th>
                        <th class="px-4 py-3">Product Cost</th>
                        <th class="px-4 py-3">Selling Price</th>
                        <th class="px-4 py-3">Total</th>
                        <th class="px-4 py-3">Profit</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @forelse($order_products as $order_product)
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3">
                            {{ $order_product->product->name }}
                            
                        </td>

                        <td class="px-4 py-3">
                            {{ $order_product->total_quantity }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $order_product->product->quantity }}
                        </td>

                        <td class="px-4 py-3">
                            ₱ {{ number_format($order_product->product->productInventory->product_cost, 2) }}
                        </td>

                        <td class="px-4 py-3">
                           
                            ₱ {{ number_format($order_product->price, 2) }}
                            
                        </td>
                        <td class="px-4 py-3">
                            
                            ₱ {{ number_format($order_product->total_amount, 2) }}
                        </td>

                        <td class="px-4 py-3">
                            <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                            ₱ {{ number_format($order_product->total_amount - ($order_product->product->productInventory->product_cost * $order_product->total_quantity), 2 ) }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr class="text-gray-700 dark:text-gray-400">
                        No sales found
                    </tr>
                    @endforelse

                    {{--<tr class="text-gray-700 bg-gray-50 dark:text-gray-400">
                        <td class="px-4 py-3 text-sm">
                            
                        </td>
                        <td class="px-4 py-3 text-sm">
                           
                        </td>
                        <td class="px-4 py-3 text-sm">
                            
                        </td>
                        <td class="px-4 py-3 text-sm font-semibold">
                            TOTAL
                        </td>
                        <td class="px-4 py-3">
                            ₱ {{ number_format($order_products->sum('total_amount'), 2) }}
                        </td>
                        <td class="px-4 py-3">
                            ₱ {{ number_format($order_products->sum('total_amount'), 2) }}
                        </td>
                    </tr>--}}
                </tbody>
            </table>
            {{ $order_products->links('livewire.pagination.defaultadmin') }}
        </div>
        
    </div>

</div>