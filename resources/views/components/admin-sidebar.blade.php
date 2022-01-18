<aside
    x-transition:enter="transition ease-in-out duration-150"
    x-transition:enter-start="opacity-0 transform -translate-x-20"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in-out duration-150"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0 transform -translate-x-20"
    id="sidebar"
    class="z-20 fixed left-0 flex flex-col max-h-screen border-r border-r-gray-300 dark:border-r-gray-700 md:border-0 overflow-hidden md:relative inset-0 flex-shrink-0 w-64 bg-white dark:bg-gray-800 md:block lg:block"
    :class="{'hidden' : !isSideMenuOpen}"
    @click.away="isSideMenuOpen = false"
    @keydown.escape="isSideMenuOpen = false"
>
    <nav class="text-gray-500 dark:text-gray-400 h-full">
        <div class="px-6 flex justify-between items-center h-16 md:border-b md:border-b-gray-300 md:dark:border-b-gray-700">
            <a class="text-lg font-bold text-gray-800 dark:text-gray-200" href="index.html">
                <span class="sr-only">Tailwind</span>
                <svg viewBox="0 0 248 31" class="text-gray-900 dark:text-white w-auto h-5">
                    <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M25.517 0C18.712 0 14.46 3.382 12.758 10.146c2.552-3.382 5.529-4.65 8.931-3.805 1.941.482 3.329 1.882 4.864 3.432 2.502 2.524 5.398 5.445 11.722 5.445 6.804 0 11.057-3.382 12.758-10.145-2.551 3.382-5.528 4.65-8.93 3.804-1.942-.482-3.33-1.882-4.865-3.431C34.736 2.92 31.841 0 25.517 0zM12.758 15.218C5.954 15.218 1.701 18.6 0 25.364c2.552-3.382 5.529-4.65 8.93-3.805 1.942.482 3.33 1.882 4.865 3.432 2.502 2.524 5.397 5.445 11.722 5.445 6.804 0 11.057-3.381 12.758-10.145-2.552 3.382-5.529 4.65-8.931 3.805-1.941-.483-3.329-1.883-4.864-3.432-2.502-2.524-5.398-5.446-11.722-5.446z"
                        fill="#38bdf8"
                        class="fill-purple-500"
                    ></path>
                    <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M76.546 12.825h-4.453v8.567c0 2.285 1.508 2.249 4.453 2.106v3.463c-5.962.714-8.332-.928-8.332-5.569v-8.567H64.91V9.112h3.304V4.318l3.879-1.143v5.937h4.453v3.713zM93.52 9.112h3.878v17.849h-3.878v-2.57c-1.365 1.891-3.484 3.034-6.285 3.034-4.884 0-8.942-4.105-8.942-9.389 0-5.318 4.058-9.388 8.942-9.388 2.801 0 4.92 1.142 6.285 2.999V9.112zm-5.674 14.636c3.232 0 5.674-2.392 5.674-5.712s-2.442-5.711-5.674-5.711-5.674 2.392-5.674 5.711c0 3.32 2.442 5.712 5.674 5.712zm16.016-17.313c-1.364 0-2.477-1.142-2.477-2.463a2.475 2.475 0 012.477-2.463 2.475 2.475 0 012.478 2.463c0 1.32-1.113 2.463-2.478 2.463zm-1.939 20.526V9.112h3.879v17.849h-3.879zm8.368 0V.9h3.878v26.06h-3.878zm29.053-17.849h4.094l-5.638 17.849h-3.807l-3.735-12.03-3.771 12.03h-3.806l-5.639-17.849h4.094l3.484 12.315 3.771-12.315h3.699l3.734 12.315 3.52-12.315zm8.906-2.677c-1.365 0-2.478-1.142-2.478-2.463a2.475 2.475 0 012.478-2.463 2.475 2.475 0 012.478 2.463c0 1.32-1.113 2.463-2.478 2.463zm-1.939 20.526V9.112h3.878v17.849h-3.878zm17.812-18.313c4.022 0 6.895 2.713 6.895 7.354V26.96h-3.878V16.394c0-2.713-1.58-4.14-4.022-4.14-2.55 0-4.561 1.499-4.561 5.14v9.567h-3.879V9.112h3.879v2.285c1.185-1.856 3.124-2.749 5.566-2.749zm25.282-6.675h3.879V26.96h-3.879v-2.57c-1.364 1.892-3.483 3.034-6.284 3.034-4.884 0-8.942-4.105-8.942-9.389 0-5.318 4.058-9.388 8.942-9.388 2.801 0 4.92 1.142 6.284 2.999V1.973zm-5.674 21.775c3.232 0 5.674-2.392 5.674-5.712s-2.442-5.711-5.674-5.711-5.674 2.392-5.674 5.711c0 3.32 2.442 5.712 5.674 5.712zm22.553 3.677c-5.423 0-9.481-4.105-9.481-9.389 0-5.318 4.058-9.388 9.481-9.388 3.519 0 6.572 1.82 8.008 4.605l-3.34 1.928c-.79-1.678-2.549-2.749-4.704-2.749-3.16 0-5.566 2.392-5.566 5.604 0 3.213 2.406 5.605 5.566 5.605 2.155 0 3.914-1.107 4.776-2.749l3.34 1.892c-1.508 2.82-4.561 4.64-8.08 4.64zm14.472-13.387c0 3.249 9.661 1.285 9.661 7.89 0 3.57-3.125 5.497-7.003 5.497-3.591 0-6.177-1.607-7.326-4.177l3.34-1.927c.574 1.606 2.011 2.57 3.986 2.57 1.724 0 3.052-.571 3.052-2 0-3.176-9.66-1.391-9.66-7.781 0-3.356 2.909-5.462 6.572-5.462 2.945 0 5.387 1.357 6.644 3.713l-3.268 1.82c-.647-1.392-1.904-2.035-3.376-2.035-1.401 0-2.622.607-2.622 1.892zm16.556 0c0 3.249 9.66 1.285 9.66 7.89 0 3.57-3.124 5.497-7.003 5.497-3.591 0-6.176-1.607-7.326-4.177l3.34-1.927c.575 1.606 2.011 2.57 3.986 2.57 1.724 0 3.053-.571 3.053-2 0-3.176-9.66-1.391-9.66-7.781 0-3.356 2.908-5.462 6.572-5.462 2.944 0 5.386 1.357 6.643 3.713l-3.268 1.82c-.646-1.392-1.903-2.035-3.375-2.035-1.401 0-2.622.607-2.622 1.892z"
                        fill="currentColor"
                    ></path>
                </svg>
            </a>
            <button type="button" @click="isSideMenuOpen = false" class="md:hidden">
                <svg viewBox="0 0 10 10" class="w-2 h-2 overflow-visible">
                    <path d="M0 0L10 10M10 0L0 10" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"></path>
                </svg>
            </button>
        </div>

        <ul id="sidebar-link" class="sidebar-link top-16 inset-y-0 overflow-y-auto fixed w-64 py-4">
            <li x-data="{ isActive: true, isOpen: true}" class="relative px-6">
                <span class="absolute inset-y-0 left-0 w-1 bg-primary rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
                <a @click="$event.preventDefault(); isOpen = !isOpen" class="py-3 flex items-center w-full text-sm font-semibold transition-colors duration-150 text-gray-800 dark:text-gray-100 hover:text-gray-800 dark:hover:text-gray-200" href="index.html">
                    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <span class="ml-4">Dashboard</span>
                </a>

            </li>

            <li x-data="{ isActive: false, isOpen: false}" class="relative px-6">
                <a @click="$event.preventDefault(); isOpen = !isOpen" class="py-3 flex items-center w-full text-sm font-semibold transition-colors duration-150 dark:text-gray-100 hover:text-gray-800 dark:hover:text-gray-200" href="index.html">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"
                        />
                    </svg>
                    <span class="ml-4">Components</span>
                    <span aria-hidden="true" class="ml-auto">
                        <!-- active class 'rotate-180' -->
                        <svg class="w-4 h-4 transition-transform transform" :class="{ 'rotate-180': isOpen }" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </span>
                </a>
                <template x-if="isOpen">
                    <ul
                        x-transition:enter="transition-all ease-in-out duration-300"
                        x-transition:enter-start="opacity-25 max-h-0"
                        x-transition:enter-end="opacity-100 max-h-xl"
                        x-transition:leave="transition-all ease-in-out duration-300"
                        x-transition:leave-start="opacity-100 max-h-xl"
                        x-transition:leave-end="opacity-0 max-h-0"
                        role="menu"
                        class="mt-2 space-y-2 pl-7"
                        aria-label="Components"
                    >
                        <!-- active & hover classes 'text-gray-700 dark:text-light' -->
                        <!-- inActive classes 'text-gray-400 dark:text-gray-400' -->
                        <li role="menuitem" class="block p-2 text-sm text-gray-400 dark:text-gray-100 transition-colors duration-200 rounded-md hover:text-gray-700">
                            <a href="alerts.html">Alerts</a>
                        </li>
                        <li role="menuitem" class="block p-2 text-sm text-gray-400 dark:text-gray-100 transition-colors duration-200 rounded-md hover:text-gray-700">
                            <a href="buttons.html">Buttons</a>
                        </li>
                        <li role="menuitem" class="block p-2 text-sm text-gray-400 dark:text-gray-100 transition-colors duration-200 rounded-md hover:text-gray-700">
                            <a href="cards.html">Cards</a>
                        </li>
                        <li role="menuitem" class="block p-2 text-sm text-gray-400 dark:text-gray-100 transition-colors duration-200 rounded-md hover:text-gray-700">
                            Dropdowns
                        </li>
                        <li role="menuitem" class="block p-2 text-sm text-gray-400 dark:text-gray-100 transition-colors duration-200 rounded-md hover:text-gray-700">
                            <a href="forms.html">Forms</a>
                        </li>
                        <li role="menuitem" class="block p-2 text-sm text-gray-400 dark:text-gray-100 transition-colors duration-200 rounded-md hover:text-gray-700">
                            Modals
                        </li>
                    </ul>
                </template>
            </li>

            <li class="relative px-6">
                <a class="py-3 flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" href="forms.html">
                    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                    </svg>
                    <span class="ml-4">Forms</span>
                </a>
            </li>
            <li class="relative px-6">
                <a class="py-3 flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" href="cards.html">
                    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    <span class="ml-4">Cards</span>
                </a>
            </li>
            <li class="relative px-6">
                <a class="py-3 flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" href="charts.html">
                    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                        <path d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                    </svg>
                    <span class="ml-4">Charts</span>
                </a>
            </li>
            <li class="relative px-6">
                <a class="py-3 flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" href="buttons.html">
                    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"></path>
                    </svg>
                    <span class="ml-4">Buttons</span>
                </a>
            </li>
            <li class="relative px-6">
                <a class="py-3 flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" href="modals.html">
                    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                    </svg>
                    <span class="ml-4">Modals</span>
                </a>
            </li>
            <li class="relative px-6">
                <a class="py-3 flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" href="tables.html">
                    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                    </svg>
                    <span class="ml-4">Tables</span>
                </a>
            </li>
            <li x-data="{ isActive: false, isOpen: false}" class="relative px-6">
                <a
                    href="#"
                    class="py-3 flex items-center justify-between w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                    @click="$event.preventDefault(); isOpen = !isOpen"
                    aria-haspopup="true"
                >
                    <span class="inline-flex items-center">
                        <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                            <path
                                d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"
                            ></path>
                        </svg>
                        <span class="ml-4">Pages</span>
                    </span>
                    <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </a>
                <template x-if="isOpen">
                    <ul
                        x-transition:enter="transition-all ease-in-out duration-300"
                        x-transition:enter-start="opacity-25 max-h-0"
                        x-transition:enter-end="opacity-100 max-h-xl"
                        x-transition:leave="transition-all ease-in-out duration-300"
                        x-transition:leave-start="opacity-100 max-h-xl"
                        x-transition:leave-end="opacity-0 max-h-0"
                        class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-gray-50 dark:text-gray-400 dark:bg-gray-900"
                        aria-label="Pages"
                    >
                        <li class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                            <a class="w-full" href="./pages/login.html">Login</a>
                        </li>
                        <li class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                            <a class="w-full" href="./pages/create-account.html">
                                Create account
                            </a>
                        </li>
                        <li class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                            <a class="w-full" href="./pages/forgot-password.html">
                                Forgot password
                            </a>
                        </li>
                        <li class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                            <a class="w-full" href="./pages/404.html">404</a>
                        </li>
                        <li class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                            <a class="w-full" href="./pages/blank.html">Blank</a>
                        </li>
                    </ul>
                </template>
            </li>
            <li class="relative px-6 py-3">
                <button
                    class="flex items-center justify-between w-full px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-primary border border-transparent rounded-lg active:bg-primary hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                    Create account
                    <span class="ml-2" aria-hidden="true">+</span>
                </button>
            </li>
        </ul>
    </nav>
</aside>