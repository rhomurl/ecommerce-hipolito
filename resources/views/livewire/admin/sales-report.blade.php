@section('title', 'Sales Report')

<div class="container px-6 mx-auto grid">
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Sales Report
    </h2>
    
    <div class="grid grid-cols-1 gap-8 p-4 lg:grid-cols-2 xl:grid-cols-4">
        <!-- Value card -->
        

        <div class="flex items-center justify-between p-4 bg-white dark:bg-gray-800 dark:text-gray-100 rounded-md">
            <div>
                <h6 class="text-xs dark:text-gray-100 font-medium leading-none tracking-wider text-gray-500 uppercase dark:text-primary-light">
                    Last 7 Days
                </h6>
                <span class="text-xl font-semibold"> {{ $this->week }}</span>
                {{--<span class="inline-block px-2 py-px ml-2 text-xs text-green-500 dark:bg-green-600 dark:text-white bg-green-100 rounded-md">
                    +{{ round($this->rev_percent_change, 2) }}% 
                </span>--}}
            </div>
            <div>
                <span>
                    <svg class="w-12 h-12 text-gray-300 dark:text-primary-dark" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                    </svg>
                </span>
            </div>
        </div>

        <!-- Users card -->
        <div class="flex items-center justify-between p-4 bg-white rounded-md dark:bg-gray-800 dark:text-gray-100">
            <div>
                <h6 class="text-xs font-medium leading-none tracking-wider text-gray-500 dark:text-gray-100 uppercase dark:text-primary-light">
                    This Month
                </h6>
                <span class="text-xl font-semibold"> {{ $this->month }}</span>
                {{--<span class="inline-block px-2 py-px ml-2 text-xs text-green-500 dark:bg-green-600 dark:text-white bg-green-100 rounded-md">
                    +{{ round($this->user_percent_change, 2) }}%
                </span>--}}
            </div>
            <div>
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-gray-300 dark:text-primary-dark" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </span>
            </div>
        </div>

        <!-- Orders card -->
        <div class="flex items-center justify-between p-4 bg-white rounded-md dark:bg-gray-800 dark:text-gray-100">
            <div>
                <h6 class="text-xs font-medium leading-none tracking-wider text-gray-500 dark:text-gray-100 uppercase dark:text-primary-light">
                    Total Amount Paid
                </h6>
                <span class="text-xl font-semibold">{{ $this->total }}</span>
                {{--<span class="inline-block px-2 py-px ml-2 text-xs text-green-500 dark:bg-green-600 dark:text-white bg-green-100 rounded-md">
                    +{{ round($this->order_percent_change, 2) }}%
                </span>--}}
            </div>
            <div>
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-300 dark:text-primary-dark" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                      </svg>
                </span>
            </div>
        </div>

        <!-- Products card -->
        <div class="flex items-center justify-between p-4 bg-white rounded-md dark:bg-gray-800 dark:text-gray-100">
            <div>
                <h6 class="text-xs font-medium leading-none tracking-wider text-gray-500 dark:text-gray-100 uppercase dark:text-primary-light">
                    Total Paid Orders
                </h6>
                <span class="text-xl font-semibold">dd</span>
                {{--<span class="inline-block px-2 py-px ml-2 text-xs text-green-500 dark:bg-green-600 dark:text-white bg-green-100 rounded-md">
                    +3.1%
                </span>--}}
            </div>
            <div>
                <span>
                    <svg class="w-12 h-12 text-gray-300 dark:text-primary-dark" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                    </svg>
                </span>
            </div>
        </div>
    </div>

</div>