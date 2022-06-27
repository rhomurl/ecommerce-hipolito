@section('title', 'Sales Report')

<div class="container px-6 mx-auto grid">
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Sales Report
    </h2>
    
    <div class="w-full overflow-hidden rounded-lg shadow-xs border border-gray-200 dark:border-gray-700">
        <div class="w-full overflow-x-auto">
            
            <table class="w-full whitespace-no-wrap">

                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left uppercase border-b dark:border-gray-700  dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3 text-right">Select report duration</th>
                        <th class="px-4 py-3">
                            <select class="block w-full mt-1 text-sm border rounded appearance-none dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                            <option>This Month</option>
                            <option>Last Month</option>
                            <option>This Year</option>
                            <option>All</option>
                            </select>
                        </th>
                        <th class="px-4 py-3"></th>
                        <th class="px-4 py-3"></th>
                       
                    </tr>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3">Date</th>
                        <th class="px-4 py-3">Orders</th>
                        <th class="px-4 py-3">Total Sales</th>
                        <th class="px-4 py-3">Total Profit</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @forelse($product_today as $today)
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3">
                            {{ $today[0]->created_at->format('M d, Y') }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                {{ $today->count() }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm">
                            ₱ {{ number_format($today->sum('total'),2) }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            00.00
                        </td>
                    </tr>
                    @empty
                    <tr class="text-gray-700 dark:text-gray-400">
                        No sales found
                    </tr>
                    @endforelse

                    <tr class="text-gray-700 bg-gray-50 dark:text-gray-400">
                        <td class="px-4 py-3 text-sm font-semibold">
                            TOTAL
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{ $this->totalc }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            ₱ {{ number_format($this->sumc,2) }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            ₱ 00.00
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
    </div>

</div>