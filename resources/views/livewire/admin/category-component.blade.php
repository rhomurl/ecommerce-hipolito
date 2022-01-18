@section('title', 'Categories')

<div class="container grid px-6 mx-auto">
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        @yield('title')
    </h2>

    <div class="px-3 my-6">
        <button onclick="Livewire.emit('openModal', 'admin.category-modal')" class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
            Create Category
            <span class="ml-2" aria-hidden="true">+</span>
        </button>
    </div>
    <div class="w-full overflow-hidden rounded-lg shadow-xs border border-gray-200 dark:border-gray-700">
        <div class="w-full overflow-x-auto">
            @if(!$isOpen)
        <div class="ml-5 mt-4 mb-5">
            <input wire:model="search" type="text" placeholder="Search category" class="px-2 py-2 text-sm text-black transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-100 focus:border-gray-500 focus:bg-white focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 " autofocus/>
        </div>
    @endif
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3">Name</th>
                        <th class="px-4 py-3">Slug</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @each('livewire.admin.category', $categories, 'category','livewire.admin.empty-table')
                </tbody>
            </table>
            @if(!$isOpen)
                {{ $categories->links() }}
            @endif
        </div>
    </div>
</div>