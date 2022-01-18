
<div>
    
<main class="flex-1 max-h-full relative">
    <div class="container px-6 mx-auto grid">
        <!-- breadcrumb -->

        <!-- breadcrumb end -->
        
        <!-- CTA -->

        <!-- CTA end -->
        <!-- Content -->
        <div class="mt-2">
            <button onclick="Livewire.emit('openModal', 'admin.banner-modal')">Edit User</button>
            <!-- State cards -->
            <div class="grid grid-cols-1 gap-8 p-4 lg:grid-cols-2 xl:grid-cols-4">
                <!-- Value card -->
                <div class="flex items-center justify-between p-4 bg-white dark:bg-gray-800 dark:text-gray-100 rounded-md">
                    <div>
                        <h6 class="text-xs dark:text-gray-100 font-medium leading-none tracking-wider text-gray-500 uppercase dark:text-primary-light">
                            Total Sales
                        </h6>
                        <span class="text-xl font-semibold">$30,000</span>
                        <span class="inline-block px-2 py-px ml-2 text-xs text-green-500 dark:bg-green-600 dark:text-white bg-green-100 rounded-md">
                            +4.4%
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
                        <span class="text-xl font-semibold">50,021</span>
                        <span class="inline-block px-2 py-px ml-2 text-xs text-green-500 dark:bg-green-600 dark:text-white bg-green-100 rounded-md">
                            +2.6%
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
                        <span class="text-xl font-semibold">45,021</span>
                        <span class="inline-block px-2 py-px ml-2 text-xs text-green-500 dark:bg-green-600 dark:text-white bg-green-100 rounded-md">
                            +3.1%
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
                        <h4 class="text-lg font-semibold text-gray-500 dark:text-white">Bar Chart</h4>
                        <div class="flex items-center space-x-2">
                            <span class="text-sm text-gray-500 dark:text-white">Last year</span>
                            <button class="relative focus:outline-none" x-cloak @click="isOn = !isOn; $parent.updateBarChart(isOn)">
                                <div class="w-12 h-6 transition rounded-full outline-none bg-gray-200"></div>
                                <div
                                    class="absolute top-0 left-0 inline-flex items-center justify-center w-6 h-6 transition-all duration-200 ease-in-out transform scale-110 rounded-full shadow-sm"
                                    :class="{ 'translate-x-0 bg-primary dark:bg-primary': !isOn, 'translate-x-6 bg-primary dark:bg-primary': isOn }"
                                ></div>
                            </button>
                        </div>
                    </div>
                    <!-- Chart -->
                    <div class="relative p-4 h-72">
                        <canvas id="barChart"></canvas>
                    </div>
                </div>

                <!-- Doughnut chart card -->
                <div class="bg-white rounded-md dark:bg-gray-800 dark:text-gray-100" x-data="{ isOn: false }">
                    <!-- Card header -->
                    <div class="flex items-center justify-between p-4 border-b dark:border-gray-600">
                        <h4 class="text-lg font-semibold text-gray-500 dark:text-light">Doughnut Chart</h4>
                        <div class="flex items-center">
                            <button class="relative focus:outline-none" x-cloak @click="isOn = !isOn; $parent.updateDoughnutChart(isOn)">
                                <div class="w-12 h-6 transition rounded-full outline-none bg-gray-200"></div>
                                <div
                                    class="absolute top-0 left-0 inline-flex items-center justify-center w-6 h-6 transition-all duration-200 ease-in-out transform scale-110 rounded-full shadow-sm"
                                    :class="{ 'translate-x-0  bg-white dark:bg-primary-100': !isOn, 'translate-x-6 bg-primary-light dark:bg-primary': isOn }"
                                ></div>
                            </button>
                        </div>
                    </div>
                    <!-- Chart -->
                    <div class="relative p-4 h-72">
                        <canvas id="doughnutChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Two grid columns -->
            <div class="grid grid-cols-1 p-4 space-y-8 lg:gap-8 lg:space-y-0 lg:grid-cols-3">
                <!-- Active users chart -->
                <div class="col-span-1 bg-white rounded-md dark:bg-gray-800 dark:text-gray-100">
                    <!-- Card header -->
                    <div class="p-4 border-b dark:border-gray-600">
                        <h4 class="text-lg font-semibold text-gray-500 dark:text-light">Active users right now</h4>
                    </div>
                    <p class="p-4">
                        <span class="text-2xl font-medium text-gray-500 dark:text-light" id="usersCount">0</span>
                        <span class="text-sm font-medium text-gray-500 dark:text-primary">Users</span>
                    </p>
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
                            <button class="relative focus:outline-none" x-cloak @click="isOn = !isOn; $parent.updateLineChart()">
                                <div class="w-12 h-6 transition rounded-full outline-none bg-gray-200"></div>
                                <div
                                    class="absolute top-0 left-0 inline-flex items-center justify-center w-6 h-6 transition-all duration-200 ease-in-out transform scale-110 rounded-full shadow-sm"
                                    :class="{ 'translate-x-0  bg-white dark:bg-primary-100': !isOn, 'translate-x-6 bg-primary-light dark:bg-primary': isOn }"
                                ></div>
                            </button>
                        </div>
                    </div>
                    <!-- Chart -->
                    <div class="relative p-4 h-72">
                        <canvas id="lineChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        
        
    </div>

    <!-- footer section start -->
    <footer class="flex-shrink-0 bg-white dark:bg-gray-800">
        <div class="container px-6 mx-auto">
            <div class="py-4 flex justify-between">
                <p class="dark:text-white text-xs md:text-sm">COPYRIGHT © 2021 <span class="text-primary cursor-pointer">PearlyDevs</span>, All rights Reserved</p>
                <p class="dark:text-white flex">
                    <span class="text-xs md:text-sm">Hand-crafted & Made with</span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" role="img" aria-hidden="true" class="h-6 w-6 fill-purple-500">
                        <path d="M12.1,18.55L12,18.65L11.89,18.55C7.14,14.24 4,11.39 4,8.5C4,6.5 5.5,5 7.5,5C9.04,5 10.54,6 11.07,7.36H12.93C13.46,6 14.96,5 16.5,5C18.5,5 20,6.5 20,8.5C20,11.39 16.86,14.24 12.1,18.55M16.5,3C14.76,3 13.09,3.81 12,5.08C10.91,3.81 9.24,3 7.5,3C4.42,3 2,5.41 2,8.5C2,12.27 5.4,15.36 10.55,20.03L12,21.35L13.45,20.03C18.6,15.36 22,12.27 22,8.5C22,5.41 19.58,3 16.5,3Z"></path>
                    </svg>
                </p>
            </div>
        </div>
    </footer>
</main>
<div>
