@section('title', 'Report Management')

<div class="container grid px-6 mx-auto">
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        @yield('title')
    </h2>

    <div class="max-w-2xl px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <h2 class="my-6 text-xl font-semibold text-gray-700 dark:text-gray-200">
            Sales Report
        </h2>
        <p class="mb-4 text-gray-600 dark:text-gray-400">
            
            <label class="block mt-4 text-sm">
                Filter by 
                <div class="relative text-gray-500 focus-within:text-gray-600">
                    
                    <select wire:model="selected_filter" class="block w-60 mt-1 text-sm border rounded appearance-none dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" required>
                        <option>-- select filter --</option>
                        <option value="date">Date</option>
                        <option value="month">Month</option>
                        <option value="year">Year</option>
                    </select>

                    @error('selected_filter')
                    <span class="text-xs text-red-600 dark:text-red-400">
                        {{ $message }}
                    </span>
                    @enderror   

                </div>
            </label>
{{--<input type="date" class="block w-full pr-20 mt-1 text-sm border rounded appearance-none p-2 text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input">--}}

            @if($selected_filter == "date")
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                    Date From
                </span>
                <div class="relative text-gray-500 focus-within:text-purple-600">
                    <input wire:model="date_from" type="date" min="{{ $ordertime }}" max="{{ $this->order_date_latest }}" class="block mt-1 text-sm border rounded appearance-none p-2 text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" required>
                    @error('date_from')
                    <span class="text-xs text-red-600 dark:text-red-400">
                        {{ $message }}
                    </span>
                    @enderror   
                </div>
            </label>

            @if($date_from)
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                    Date To (optional)
                </span>
                <div class="relative text-gray-500 focus-within:text-purple-600">
                    <input wire:model="date_to" type="date" min="{{ $this->date_from }}" class="block mt-1 text-sm border rounded appearance-none p-2 text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input">
                </div>
            </label>
            @endif

            
            @elseif($selected_filter == "month")
            <label class="block mt-4 text-sm">
                Filter by Month
                <div>
                    <label class="block mt-4 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">
                            Month and Year From
                        </span>
                        <select wire:model="month_from" class="w-auto mt-1 text-sm border rounded appearance-none dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                            <option>-- Select month from --</option>
                            @for($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}">{{ date('M', strtotime('2022-'.$i.'-01')) }}</option>
                            @endfor
                        </select>
                    
                        <select wire:model="year_from" min="{{ $this->min_year }}" max="{{ $this->max_year }}" class="w-auto mt-1 text-sm border rounded appearance-none dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                            <option>-- Select year from --</option>
                            @foreach(range(date('Y'), date('Y')-$this->year_gap) as $y)
                            <option value="{{$y}}">{{$y}}</option>
                            @endforeach
                        </select>
                    </label>
                    
                </div>

                @if($this->month_from && $this->year_from)
                <div class="mt-2">
                    <label class="block mt-4 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">
                            Month and Year To
                        </span>
                        <select wire:model="month_to" class="w-auto mt-1 text-sm border rounded appearance-none dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                            <option>-- Select month to --</option>
                            @for($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}">{{ date('M', strtotime('2022-'.$i.'-01')) }}</option>
                            @endfor
                        </select>
                        <select wire:model="year_to" min="{{ $this->min_year }}" max="{{ $this->max_year }}" class="w-auto mt-1 text-sm border rounded appearance-none dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                            <option>-- Select year to --</option>
                            @foreach(range(date('Y'), date('Y')-$this->year_gap) as $y)
                            <option value="{{$y}}">{{$y}}</option>
                            @endforeach
                        </select>
                    </label>
                </div>
                @endif
            </label>
            @elseif($selected_filter == "year")
            <label class="block mt-4 text-sm">
                Filter by Year

                <label class="block mt-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">
                        Year From
                    </span>
                    <select wire:model="year_from" min="{{ $this->min_year }}" max="{{ $this->max_year }}" class="block w-50 mt-1 text-sm border rounded appearance-none dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                        <option>-- Select year from --</option>
                        @foreach(range(date('Y'), date('Y')-$this->year_gap) as $y)
                        <option value="{{$y}}">{{$y}}</option>
                        @endforeach
                    </select>
                </label>

                @if($this->year_from)
                <label class="block mt-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">
                        Year To
                    </span>
                    <select wire:model="year_to" min="{{ $this->min_year }}" max="{{ $this->max_year }}" class="block w-50 mt-1 text-sm border rounded appearance-none dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                        <option>-- Select year to --</option>
                        @foreach(range(date('Y'), date('Y')-$this->year_gap) as $y)
                        <option value="{{$y}}">{{$y}}</option>
                        @endforeach
                    </select>
                </label>
                @endif
            </label>
            @endif

            @if($selected_filter)
            <label class="block mt-4 text-sm">
                Group by (optional)
                <div class="relative text-gray-500 focus-within:text-purple-600">
                    
                    <select wire:model="group_by" class="block w-60 mt-1 text-sm border rounded appearance-none dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                        <option>-- select group --</option>
                        @if($selected_filter == 'date')
                            <option value="date">Date</option>
                        @else
                            <option value="date">Date</option>
                            <option value="month_year">Month and Year</option>
                            @if($this->year_to  )<option value="year">Year</option>@endif
                        @endif
                    </select>
                </div>
            </label>
            @endif

            <div class="mt-4">
                <a wire:click.prevent="submit" class="px-4 py-2  text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    Submit
                </a>
            </div>
        </p>

        
    </div>

    <div class="max-w-2xl px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <h2 class="my-6 text-xl font-semibold text-gray-700 dark:text-gray-200">
            Product Sales Report
        </h2>
        <p class="mb-4 text-gray-600 dark:text-gray-400">
        
            <div class="mt-4">
                <a href="{{ route('admin.product-sales-report') }}" class="px-4 py-2  text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    Go
                </a>
            </div>
        </p>

        
    </div>

    
    
</div>
