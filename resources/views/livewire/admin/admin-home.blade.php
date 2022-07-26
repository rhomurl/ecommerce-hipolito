@section('title', 'Dashboard')

<div>
    
<main class="flex-1 max-h-full relative">
    <div class="container px-6 mx-auto grid">
        <!-- breadcrumb -->

        <!-- breadcrumb end -->
        
        <!-- CTA -->

        <!-- CTA end -->
        <!-- Content -->
        <div class="mt-2">
            <!-- State cards -->
            <div class="grid grid-cols-1 gap-8 p-4 lg:grid-cols-2 xl:grid-cols-4">
                <!-- Value card -->
                

                <div class="flex items-center justify-between p-4 bg-white dark:bg-gray-800 dark:text-gray-100 rounded-md">
                    <div>
                        <h6 class="text-xs dark:text-gray-100 font-medium leading-none tracking-wider text-gray-500 uppercase dark:text-primary-light">
                            Total Sales
                        </h6>
                        <span class="text-xl font-semibold">₱{{ number_format($this->trev_current_count, 2) }}</span>
                        {{--<span class="inline-block px-2 py-px ml-2 text-xs text-green-500 dark:bg-green-600 dark:text-white bg-green-100 rounded-md">
                            +{{ round($this->rev_percent_change, 2) }}% 
                        </span>--}}
                    </div>
                    <div>
                        <span>
                            <svg class="w-12 h-12 text-gray-300 dark:text-primary-dark" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                />
                            </svg>
                        </span>
                    </div>
                </div>

                <!-- Users card -->
                <div class="flex items-center justify-between p-4 bg-white rounded-md dark:bg-gray-800 dark:text-gray-100">
                    <div>
                        <h6 class="text-xs font-medium leading-none tracking-wider text-gray-500 dark:text-gray-100 uppercase dark:text-primary-light">
                            Registered Users
                        </h6>
                        <span class="text-xl font-semibold">{{ $this->user_current_count }}</span>
                        {{--<span class="inline-block px-2 py-px ml-2 text-xs text-green-500 dark:bg-green-600 dark:text-white bg-green-100 rounded-md">
                            +{{ round($this->user_percent_change, 2) }}%
                        </span>--}}
                    </div>
                    <div>
                        <span>
                            <svg class="w-12 h-12 text-gray-300 dark:text-primary-dark" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </span>
                    </div>
                </div>

                <!-- Orders card -->
                <div class="flex items-center justify-between p-4 bg-white rounded-md dark:bg-gray-800 dark:text-gray-100">
                    <div>
                        <h6 class="text-xs font-medium leading-none tracking-wider text-gray-500 dark:text-gray-100 uppercase dark:text-primary-light">
                            Orders
                        </h6>
                        <span class="text-xl font-semibold">{{ $this->totalOrders }}</span>
                        {{--<span class="inline-block px-2 py-px ml-2 text-xs text-green-500 dark:bg-green-600 dark:text-white bg-green-100 rounded-md">
                            +{{ round($this->order_percent_change, 2) }}%
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

                <!-- Products card -->
                <div class="flex items-center justify-between p-4 bg-white rounded-md dark:bg-gray-800 dark:text-gray-100">
                    <div>
                        <h6 class="text-xs font-medium leading-none tracking-wider text-gray-500 dark:text-gray-100 uppercase dark:text-primary-light">
                            Products
                        </h6>
                        <span class="text-xl font-semibold">{{ $this->registered_products->count() }}</span>
                        {{--<span class="inline-block px-2 py-px ml-2 text-xs text-green-500 dark:bg-green-600 dark:text-white bg-green-100 rounded-md">
                            +3.1%
                        </span>--}}
                    </div>
                    <div>
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-300 dark:text-primary-dark" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Charts -->
            <div class="grid grid-cols-1 p-4 space-y-8 lg:gap-8 lg:space-y-0 lg:grid-cols-3">
                <!-- Bar chart card -->
                <div class="col-span-2 bg-white rounded-md dark:bg-gray-800 dark:text-gray-100" x-data="{ isOn: false }">
                    <!-- Card header -->
                    <div class="flex items-center justify-between p-4 border-b dark:border-gray-600">
                        <h4 class="text-lg font-semibold text-gray-500 dark:text-white">Total Revenue</h4>
                        <div class="flex items-center space-x-2">
                            <span class="text-sm text-gray-500 dark:text-white">Last 7 days</span>
                        </div>
                    </div>
                    <!-- Chart -->
                    <div class="relative p-4 h-72">
                        {!! $orderchart->container() !!}
                    </div>
                </div>

                <!-- Doughnut chart card -->
                <div class="bg-white rounded-md dark:bg-gray-800 dark:text-gray-100" x-data="{ isOn: false }">
                    <!-- Card header -->
                    <div class="flex items-center justify-between p-4 border-b dark:border-gray-600">
                        <h4 class="text-lg font-semibold text-gray-500 dark:text-white">Registered Users</h4>
                        <div class="flex items-center space-x-2">
                            <span class="text-sm text-gray-500 dark:text-white">Last 3 days</span>
                        </div>
                    </div>
                    <!-- Chart -->
                    <div class="relative p-4 h-72">
                        {!! $userchart->container() !!}
                    </div>
                </div>
            </div>

            <!-- Two grid columns -->
            <div class="grid grid-cols-1 p-4 space-y-8 lg:gap-8 lg:space-y-0 lg:grid-cols-3">
                <!-- Active users chart -->
                <div class="col-span-1 bg-white rounded-md dark:bg-gray-800 dark:text-gray-100">
                    <!-- Card header -->
                    <div class="p-4 border-b dark:border-gray-600">
                        <h4 class="text-lg font-semibold text-gray-500 dark:text-primary-light dark:text-gray-100">Top 5 Products</h4>
                    </div>

                    <!-- Card 1 -->

                    <td class="px-4 py-3">
                        @forelse ($topProducts as $topProduct)

                        <card class="border-gray-300 rounded-xl w-[30rem] py-7 px-5">
                            <div class="grid grid-cols-6 gap-3">
                              
                              <!-- Image -->
                              <div class="col-span-2">
                                <img src="{{ $this->getProductURL($topProduct->product->image) }}" class="rounded-full" />
                              </div>
                        
                              <!-- Description -->
                              <div class="col-span-4">
                                <p class="text-gray-700 font-bold dark:text-primary-light dark:text-gray-100"> {{ $topProduct->product->name }} </p>
                                <p class="text-gray-500 mt-4 dark:text-primary-light dark:text-gray-100"> {{ $topProduct->product_qty . ' sold' }} </p>
                              </div>
                        
                            </div>
                          </card>
                        @empty
                          No top products found
                        @endforelse
                    </td>
                    {{--<p class="p-4">
                        <span class="text-2xl font-medium text-gray-500 dark:text-light" id="usersCount">0</span>
                        <span class="text-sm font-medium text-gray-500 dark:text-primary">Users</span>
                    </p>--}}
                    <!-- Chart -->
                    <div class="relative p-4">
                        <canvas id="activeUsersChart"></canvas>
                    </div>
                </div>

                <!-- Line chart card -->
               <div class="col-span bg-white rounded-md dark:bg-gray-800 dark:text-gray-100" x-data="{ isOn: false }">
                    <!-- Card header -->
                    <div class="flex items-center justify-between p-4 border-b dark:border-gray-600">
                        <h4 class="text-lg font-semibold text-gray-500 dark:text-primary-light dark:text-gray-100">Orders</h4>
                        
                    </div>
                    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-xs border border-gray-200 dark:border-gray-700">
                        <div class="w-full overflow-x-auto">
                            <table class="w-full whitespace-no-wrap">
                                <thead>
                                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                        <th class="px-4 py-3">Status</th>
                                        <th class="px-4 py-3">Order Count</th>
                                        <th class="px-4 py-3">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                    
                                    {{-- Ordered Row--}}
                                    <tr class="text-gray-700 dark:text-gray-400">
                                        <td class="px-4 py-3 text-s">
                                            <span class="px-2 py-1 font-semibold leading-tight text-orange-700 bg-orange-100 rounded-full dark:text-white dark:bg-orange-600">
                                                Ordered
                                            </span>
                                        </td>
                                        <td class="px-4 py-3">
                                           {{ $this->ordered->count() }}
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            <a href="{{ route('admin.orders', 'ordered') }}" class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                                View
                                            </a>
                                        </td>
                                    </tr>
                                    {{-- End Ordered Row--}}

                                    {{-- Processing Row--}}
                                    <tr class="text-gray-700 dark:text-gray-400">
                                        <td class="px-4 py-3 text-s">
                                            <span class="px-2 py-1 font-semibold leading-tight text-teal-700 bg-teal-100 rounded-full dark:bg-teal-700 dark:text-teal-100">
                                                Processing
                                            </span>
                                        </td>
                                        <td class="px-4 py-3">
                                            {{ $this->process->count() }}
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            <a href="{{ route('admin.orders', 'processing') }}" class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                                View
                                            </a>
                                        </td>
                                    </tr>
                                    {{-- End Processing Row--}}

                                    {{-- Shipping Row--}}
                                    <tr class="text-gray-700 dark:text-gray-400">
                                        <td class="px-4 py-3 text-s">
                                            <span class="px-2 py-1 font-semibold leading-tight text-blue-500 bg-blue-100 rounded-full dark:bg-blue-700 dark:text-blue-100">
                                                Shipping
                                            </span>
                                        </td>
                                        <td class="px-4 py-3">
                                            {{ $this->otw->count() }}
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            <a href="{{ route('admin.orders', 'otw') }}" class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                                View
                                            </a>
                                        </td>
                                    </tr>
                                    {{-- End Shipping Row--}}

                                    {{-- Completed Row--}}
                                    <tr class="text-gray-700 dark:text-gray-400">
                                        <td class="px-4 py-3 text-s">
                                            <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                                Delivered
                                            </span>
                                        </td>
                                        <td class="px-4 py-3">
                                            {{ $this->completed->count() }}
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            <a href="{{ route('admin.orders', 'delivered') }}" class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                                View
                                            </a>
                                        </td>
                                    </tr>
                                    {{-- End Completed Row--}}
                                </tbody>
                            </table>
                        </div>
                        
                    </div>

                    <h4 class="p-4 border-b text-lg font-semibold text-gray-500 dark:text-primary-light dark:text-gray-100">Recent Orders</h4>
                    <div class="w-full overflow-x-auto">
                        <table class="w-full whitespace-no-wrap">
                                <thead>
                                    @if($this->recent_orders->count() != 0)
                                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                        <th class="px-4 py-3"></th>
                                        <th class="px-4 py-3">Status</th>
                                        <th class="px-4 py-3">Action</th>
                                    </tr>
                                    @endif
                                </thead>
                            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                @forelse($this->recent_orders as $recent_order)
                                    <tr class="text-gray-700 dark:text-gray-400">
                                        <td class="px-4 py-3">
                                            <div class="flex items-center text-sm">
                                                <div>
                                                    <p class="font-semibold">Order #{{ $recent_order->id }}</p>
                                                    <p class="text-xs text-gray-600 dark:text-gray-400">
                                                        {{ $recent_order->user->name }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="px-4 py-3 text-sm">
                                            <span>
                                                {{ $recent_order->getOrderStatusAttribute() }}
                                            </span>
                                        </td>

                                        <td class="px-4 py-3">
                                            <div class="flex items-center space-x-4 text-sm">
                                                <a href="{{ route('admin.order.details', $recent_order->id) }}" target="_blank" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Delete">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                      </svg>
                                                    </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    No recent orders found
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                </div>

               
                <div class="col-span bg-white rounded-md dark:bg-gray-800 dark:text-gray-100" x-data="{ isOn: false }">
                     {{--Notification
                    <div class="flex items-center justify-between p-4 border-b dark:border-gray-600">
                        <h4 class="text-lg font-semibold text-gray-500 dark:text-primary-light dark:text-gray-100">Notifications</h4>
                        
                    </div>
                    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-xs border border-gray-200 dark:border-gray-700">
                        Notification section here
                        
                    </div>--}}

                    <h4 class="p-4 border-b text-lg font-semibold text-gray-500 dark:text-primary-light dark:text-gray-100">Activity Log</h4>
                    <!-- Chart -->
                    <table class="w-full whitespace-no-wrap">
                                        
                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                            @forelse($this->activity_log as $log)
                                <tr class="text-gray-700 dark:text-gray-400">
                                    <td class="px-4 py-3 text-sm">
                                        {{ $log->description }}
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        {{ changeDateFormat1($log->created_at) }}
                                    </td>
                                </tr>
                            @empty
                                No logs found
                            @endforelse

                            @if($this->activity_log->count() != 0)
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3 text-sm">
                                    <a href="{{ route('admin.activity-log') }}" class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                        <span>More</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                                          </svg>
                                    </a>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                </td>
                            </tr>
                            @endif

                        </tbody>
                    </table>

                    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-xs border border-gray-200 dark:border-gray-700">
                    </div>
                    
                </div>
                {{--End notification--}}
            </div>
        </div>
    </div>
</main>
<div>

    {!! $orderchart->script() !!}
    {!! $userchart->script() !!}
