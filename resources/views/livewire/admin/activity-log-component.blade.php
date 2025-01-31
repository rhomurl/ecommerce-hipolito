@section('title', 'Activity Log')

<div class="container grid px-6 mx-auto">
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        @yield('title')
    </h2>

    <div class="w-full overflow-hidden rounded-lg shadow-xs border border-gray-200 dark:border-gray-700">
        <div class="w-full overflow-x-auto">
            
        <div class="ml-5 mt-4 mb-5">
            <input wire:model="search" type="text" placeholder="Search activity" class="px-2 py-2 text-sm text-black transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-100 focus:border-gray-500 focus:bg-white focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 " autofocus/>
        </div>

        <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400">
            <li class="mr-2">
                <a href="{{ route('admin.activity-log', 'all') }}" aria-current="page" class="inline-block p-4 rounded-t-lg @if($this->role == 'all') text-blue-600 bg-gray-100 active border-b-2 border-blue-600 dark:bg-gray-800 dark:text-blue-500 @else hover:text-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 dark:hover:text-gray-300 @endif">All</a>
            </li>
            <li class="mr-2">
                <a href="{{ route('admin.activity-log', 'customer') }}" class="inline-block p-4 @if($this->role == 'customer') text-blue-600 bg-gray-100 active border-b-2 border-blue-600 dark:bg-gray-800 dark:text-blue-500 @else hover:text-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 dark:hover:text-gray-300 @endif">Customer</a>
            </li>
            <li class="mr-2">
                <a href="{{ route('admin.activity-log', 'admin') }}" class="inline-block p-4 @if($this->role == 'admin') text-blue-600 bg-gray-100 active border-b-2 border-blue-600 dark:bg-gray-800 dark:text-blue-500 @else hover:text-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 dark:hover:text-gray-300 @endif">Admin</a>
            </li>
            @role('super-admin')
            <li class="mr-2">
                <a href="{{ route('admin.activity-log', 'super-admin') }}" class="inline-block p-4 @if($this->role == 'super-admin') text-blue-600 bg-gray-100 active border-b-2 border-blue-600 dark:bg-gray-800 dark:text-blue-500 @else hover:text-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 dark:hover:text-gray-300 @endif">Super admin</a>
            </li>
            @endrole
            
        </ul>
    
        <table class="w-full whitespace-no-wrap">
            <thead>
                <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-3">Description</th>
                    <th class="px-4 py-3">Action by</th>
                    <th wire:click="sortByColumn('created_at')" class="px-4 py-3">Date and Time
                        @if ($sortColumn == 'created_at')
                                <i class="fa fa-fw fa-sort-{{ $sortDirection }}"></i>
                            @else
                                <i class="fa fa-fw fa-sort" style="color:#DCDCDC"></i>
                            @endif
                    </th>
                    {{--<th class="px-4 py-3">Action</th>--}}
                    <th class="px-4 py-3">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                
                @forelse($activities as $activity)
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3">
                            <div class="flex items-center text-sm">
                                <!-- Avatar with inset shadow -->
                                <div>
                                    <p class="font-semibold">{{ $activity->description }} </p>
                                </div>
                            </div>
                        </td>
                        
                        <td class="px-4 py-3">
                            <div class="flex items-center text-sm">
                                <!-- Avatar with inset shadow -->
                                <div>
                                    <p class="font-semibold">{{ $activity->user->name }}</p>
                                </div>
                            </div>
                        </td>

                        <td class="px-4 py-3">
                            <div class="flex items-center text-sm">
                                <!-- Avatar with inset shadow -->
                                <div>
                                    <p class="font-semibold">{{ changeDateFormat1($activity->created_at) }}</p>
                                </div>
                            </div>
                        </td>
                        
                        
                        <td class="px-4 py-3">
                            <div class="flex items-center space-x-4 text-sm">
                                <button wire:click.prevent="view({{$activity->id}})" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 hover:bg-gray-200 focus:outline-none focus:shadow-outline-gray" aria-label="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td colspan="3" class="w-full px-4 py-3">No results</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $activities->links('livewire.pagination.defaultadmin') }}
        </div>
    </div>
</div>