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
                        <span class="text-xl font-semibold">₱{{ $this->trev_current_count }}</span>
                        <span class="inline-block px-2 py-px ml-2 text-xs text-green-500 dark:bg-green-600 dark:text-white bg-green-100 rounded-md">
                            +{{ round($this->rev_percent_change, 2) }}% 
                        </span>
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
                        <span class="inline-block px-2 py-px ml-2 text-xs text-green-500 dark:bg-green-600 dark:text-white bg-green-100 rounded-md">
                            +{{ round($this->user_percent_change, 2) }}%
                        </span>
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
                        <span class="inline-block px-2 py-px ml-2 text-xs text-green-500 dark:bg-green-600 dark:text-white bg-green-100 rounded-md">
                            +{{ round($this->order_percent_change, 2) }}%
                        </span>
                    </div>
                    <div>
                        <span>
                            <svg class="w-12 h-12 text-gray-300 dark:text-primary-dark" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                            </svg>
                        </span>
                    </div>
                </div>

                <!-- Tickets card -->
                <div class="flex items-center justify-between p-4 bg-white rounded-md dark:bg-gray-800 dark:text-gray-100">
                    <div>
                        <h6 class="text-xs font-medium leading-none tracking-wider text-gray-500 dark:text-gray-100 uppercase dark:text-primary-light">
                            Tickets
                        </h6>
                        <span class="text-xl font-semibold">20,516</span>
                        <span class="inline-block px-2 py-px ml-2 text-xs text-green-500 dark:bg-green-600 dark:text-white bg-green-100 rounded-md">
                            +3.1%
                        </span>
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
                        <h4 class="text-lg font-semibold text-gray-500 dark:text-white">Total Revenue (Last 7 days)</h4>
                        <div class="flex items-center space-x-2">
                            <span class="text-sm text-gray-500 dark:text-white">Last year</span>
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
                        <h4 class="text-lg font-semibold text-gray-500 dark:text-light">Top 5 Products</h4>
                    </div>
                    <ol class="list-decimal">
                    @foreach ($topProducts as $topProduct)
                    
                        <img src="{{ $this->getProductURL($topProduct->product->image) }}" height="25%" width="25%"/>
                        <li class="text-xl ml-6 border-b font-medium text-gray-500 dark:text-light">{{ $topProduct->product->name }} - {{ $topProduct->product_qty . ' sold' }}  {{--(₱ $topProduct->product_total)--}} </li>
                    
                    @endforeach
                    </ol>
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
                <div class="col-span-2 bg-white rounded-md dark:bg-gray-800 dark:text-gray-100" x-data="{ isOn: false }">
                    <!-- Card header -->
                    <div class="flex items-center justify-between p-4 border-b dark:border-gray-600">
                        <h4 class="text-lg font-semibold text-gray-500 dark:text-light">Line Chart</h4>
                        <div class="flex items-center">
                           
                        </div>
                    </div>
                    <!-- Chart -->
                    
                </div>
            </div>
        </div>
    </div>
</main>
<div>

    {!! $orderchart->script() !!}
    {!! $userchart->script() !!}
