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
                            <svg class="w-12 h-12 text-gray-300 dark:text-primary-dark" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
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
                        <h4 class="text-lg font-semibold text-gray-500 dark:text-light">Registered Users (Last 3 days)</h4>
                        <div class="flex items-center">
                            
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
                        @foreach ($topProducts as $topProduct)

                        <card class="border-gray-300 rounded-xl w-[30rem] py-7 px-5">
                            <div class="grid grid-cols-6 gap-3">
                              
                              <!-- Image -->
                              <div class="col-span-2">
                                <img src="{{ $this->getProductURL($topProduct->product->image) }}" />
                              </div>
                        
                              <!-- Description -->
                              <div class="col-span-4">
                                <p class="text-gray-700 font-bold dark:text-primary-light dark:text-gray-100"> {{ $topProduct->product->name }} </p>
                                <p class="text-gray-500 mt-4 dark:text-primary-light dark:text-gray-100"> {{ $topProduct->product_qty . ' sold' }} </p>
                              </div>
                        
                            </div>
                          </card>
                        @endforeach
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
                                        <th class="px-4 py-3">Count</th>
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
                                                To Process
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
                                                Completed
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
                    <!-- Chart -->
                    
                </div>

                {{--Notification--}}
                <div class="col-span bg-white rounded-md dark:bg-gray-800 dark:text-gray-100" x-data="{ isOn: false }">
                    <!-- Card header -->
                    <div class="flex items-center justify-between p-4 border-b dark:border-gray-600">
                        <h4 class="text-lg font-semibold text-gray-500 dark:text-primary-light dark:text-gray-100">Notifications</h4>
                        
                    </div>
                    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-xs border border-gray-200 dark:border-gray-700">
                        fsdfsdf
                        
                    </div>

                    <h4 class="p-4 border-b text-lg font-semibold text-gray-500 dark:text-primary-light dark:text-gray-100">Recent Orders</h4>
                    <!-- Chart -->
                    
                </div>
                {{--End notification--}}
            </div>
        </div>
    </div>
</main>
<div>

    {!! $orderchart->script() !!}
    {!! $userchart->script() !!}
