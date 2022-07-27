@section('title', 'User Orders')

<div class="container grid px-6 mx-auto">
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        @yield('title')
    </h2>
    <div class="ml-5 mt-4 mb-5">
        <input wire:model="search" type="text" placeholder="Search order" class="px-2 py-2 text-sm text-black transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-100 focus:border-gray-500 focus:bg-white focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 " autofocus="">
    </div>
    <div class="w-full overflow-hidden rounded-lg shadow-xs border border-gray-200 dark:border-gray-700">
        <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400">
            <li class="mr-2">
                <a href="{{ route('admin.orders', 'all') }}" aria-current="page" class="inline-block p-4 rounded-t-lg @if($this->status == "all") text-blue-600 bg-gray-100 active border-b-2 border-blue-600 dark:bg-gray-800 dark:text-blue-500 @else hover:text-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 dark:hover:text-gray-300 @endif">All ({{$this->all}})</a>
            </li>
            <li class="mr-2">
                <a href="{{ route('admin.orders', 'ordered') }}" class="inline-block p-4 @if($this->status == "ordered") text-blue-600 bg-gray-100 active border-b-2 border-blue-600 dark:bg-gray-800 dark:text-blue-500 @else hover:text-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 dark:hover:text-gray-300 @endif">Ordered ({{$this->ordered}})</a>
            </li>
            <li class="mr-2">
                <a href="{{ route('admin.orders', 'processing') }}" class="inline-block p-4 rounded-t-lg @if($this->status == "processing") text-blue-600 bg-gray-100 active border-b-2 border-blue-600 dark:bg-gray-800 dark:text-blue-500 @else hover:text-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 dark:hover:text-gray-300 @endif">To Process ({{$this->process}})</a>
            </li>
            <li class="mr-2">
                <a href="{{ route('admin.orders', 'otw') }}" class="inline-block p-4 rounded-t-lg @if($this->status == "otw") text-blue-600 bg-gray-100 active border-b-2 border-blue-600 dark:bg-gray-800 dark:text-blue-500 @else hover:text-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 dark:hover:text-gray-300 @endif">Shipping ({{$this->otw}})</a>
            </li>
            <li class="mr-2">
                <a href="{{ route('admin.orders', 'delivered') }}" class="inline-block p-4 rounded-t-lg @if($this->status == "delivered") text-blue-600 bg-gray-100 active border-b-2 border-blue-600 dark:bg-gray-800 dark:text-blue-500 @else hover:text-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 dark:hover:text-gray-300 @endif">Completed ({{$this->completed}})</a>
            </li>
            <li class="mr-2">
                <a href="{{ route('admin.orders', 'cancelled') }}" class="inline-block p-4 rounded-t-lg @if($this->status == "cancelled") text-blue-600 bg-gray-100 active border-b-2 border-blue-600 dark:bg-gray-800 dark:text-blue-500 @else hover:text-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 dark:hover:text-gray-300 @endif">Cancelled ({{$this->cancelled}})</a>
            </li>
            {{-- 
            <li>
                <a class="inline-block p-4 text-gray-400 rounded-t-lg cursor-not-allowed dark:text-gray-500">Disabled</a>
            </li>--}}
        </ul>
        <div class="w-full overflow-x-auto">

            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th wire:click="sortByColumn('id')" class="px-4 py-3">Order ID
                            @if ($sortColumn == 'id')
                                <i class="fa fa-fw fa-sort-{{ $sortDirection }}"></i>
                            @else
                                <i class="fa fa-fw fa-sort" style="color:#DCDCDC"></i>
                            @endif  
                        </th>
                        <th class="px-4 py-3">Account Name</th>
                        <th wire:click="sortByColumn('total')" class="px-4 py-3">Order Total
                            @if ($sortColumn == 'total')
                                <i class="fa fa-fw fa-sort-{{ $sortDirection }}"></i>
                            @else
                                <i class="fa fa-fw fa-sort" style="color:#DCDCDC"></i>
                            @endif  
                        </th>
                        <th @if($this->status == 'all') wire:click="sortByColumn('status')" @endif class="px-4 py-3">Status
                            @if($this->status == 'all')
                                @if ($sortColumn == 'status')
                                    <i class="fa fa-fw fa-sort-{{ $sortDirection }}"></i>
                                @else
                                    <i class="fa fa-fw fa-sort" style="color:#DCDCDC"></i>
                                @endif  
                            @endif
                        </th>
                        <th class="px-4 py-3">Processed by</th>
                        <th class="px-4 py-3">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @each('livewire.admin.order', $orders, 'order','livewire.admin.empty-table')
                </tbody>
            </table>
           
                {{ $orders->links('livewire.pagination.defaultadmin') }}
           </div>
    </div>
</div>