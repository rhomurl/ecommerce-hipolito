@section('title', 'Order Details - Order #' . $order->id )

<div class="container grid px-6 mx-auto">
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        @yield('title')
    </h2>

   
    
{{--@if ($message = Session::get('message'))
    <div role="alert">
    <div class="bg-green-500 text-white font-bold rounded-t px-4 py-2">
        Success
    </div>
    <div class="mb-5 border border-t-0 border-green-400 rounded-b bg-blue-100 px-4 py-3 text-green-700">
        <p>{{ $message }}</p>
    </div>
    </div>
@endif--}}


<div>
    <button wire:click.prevent="redirectTo('admin.orders')" class="flex items-center justify-between mb-3 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
          </svg>
        <span>Go to Orders</span>
    </button>
</div>
{{--<a href="{{ route('admin.genOrderPDF', $order->uuid) }}" class="mb-3">
    Get Invoice
</a>--}}
    <div class="grid gap-6 mb-8 md:grid-cols-2">
        <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
            <h4 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                User Details
            </h4>

            <p class="text-gray-600 dark:text-gray-400">
            <b>Name:</b> {{ $order->user->name }}<br>
            <b>Email:</b> {{ $order->user->email }}
            </p>


            <h4 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                Delivery Address
            </h4>
            <p class="text-gray-600 dark:text-gray-400">
                @if($address->entry_company)
                    {{ $address->entry_company }}<br>
                @endif
                {{ $address->entry_street_address }}<br>
                <b>Landmark:</b> {{ $address->entry_landmark }}
                <br> {{ $address->barangay->name }}, 
                {{ $address->barangay->city->name }}, 
                {{ $address->barangay->city->zip }}
                <br>{{ $address->entry_phonenumber }}  
            </p>

            
            
       
        </div>
        
        <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
            <h4 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                Payment Information
            </h4>
            <p class="text-gray-600 dark:text-gray-400">
                <b>Subtotal:</b> ₱ {{ number_format($order->subtotal, 2) }}<br>
                <b>Shipping:</b> ₱ {{ number_format($order->shippingfee, 2) }} <br>
                {{--<b>Discount:</b> ₱ {{ $order->discount }}<br>--}}
                <b>Order Total:</b> ₱ {{ number_format($order->total, 2) }}<br><br>
           
            <b>Order Status:</b> {{ $order->getOrderStatusAttribute() }}
            
            @if(!$status)
                @if($order->status == 'processing' || $order->status == 'otw' || $order->status == 'ordered' )
                    <br><button wire:click.prevent="changeStatus1()" class="px-4 mt-2 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    Change Status
                </button>
                @elseif($order->status ='delivered')
                    
                @endif
            @endif

            @if($status)
                <select wire:model="order_status" class="block w-sm mt-1 text-sm border rounded appearance-none dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                    <option value="" selected>-- select status --</option>
                    <option value="processing" {{ $order->status == 'processing' ? 'selected': '' }}>Processing</option>
                    <option value="otw" {{ $order->status == 'otw' ? 'selected': '' }}>On The Way</option>
                    <option value="delivered" {{ $order->status == 'delivered' ? 'selected': '' }}>Delivered</option>
                </select>

                <div class="d-flex">
                    <button wire:click.prevent="changeStatus2()" class="px-4 mt-2 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    Save Changes
                    </button>
                
                
                    <button wire:click.prevent="cancelStatus()" class="px-4 mt-2 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    Cancel
                    </button>
                </div>
            @endif            

            </p>

            <h4 class="my-6 text-xl font-semibold text-gray-700 dark:text-gray-200">
                Payment Method
            </h4>
            
            <p class="text-gray-600 dark:text-gray-400 mb-5">
               @if($order->transaction->mode == "paypal") 
                <img src="{{ asset("images/misc/payment-paypal.png") }}" class="float-left" height="24">
                    @if($order->transaction->status != 'cancelled')
                        <button wire:click.prevent="viewPaypal( {{ $order->id }} )" class="ml-5 px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                            View Paypal Details
                        </button>
                    @endif
                @elseif($order->transaction->mode == "cod")
                    Cash on Delivery
               @endif
               
            </p>

        </div>
    </div>

    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-xs border border-gray-200 dark:border-gray-700">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3">Product Name</th>
                        <th class="px-4 py-3">Quantity</th>
                        <th class="px-4 py-3">Price</th>
                        <th class="px-4 py-3">Total</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @foreach ($order->orderProduct as $item)
                        <tr class="text-gray-700 dark:text-gray-400">
                            <td class="px-4 py-3">
                                <div class="flex items-center text-sm">
                                    <!-- Avatar with inset shadow -->
                                    <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                                        <img class="object-cover w-full h-full rounded-full" src="{{ $this->getProductURL($item->product->image) }}" onerror="this.src='{{ asset('storage/app/public/') }}/{{ $item->product->image }}'" alt="" loading="lazy">
                                        <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                                    </div>
                                    <div>
                                        <p class="font-semibold">{{ $item->product->name }}</p>
                                        <p class="text-xs text-gray-600 dark:text-gray-400">
                                            Brand: {{ $item->product->brand->name }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $item->quantity }}
                            </td>
                            <td class="px-4 py-3 text-xs">
                                <span class="px-2 py-1 font-semibold leading-tight text-orange-700 bg-orange-100 rounded-full dark:text-white dark:bg-orange-600">
                                ₱ {{ number_format($item->product->selling_price, 2) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                ₱ {{ number_format($item->quantity * $item->product->selling_price, 2) }} 
                            </td>
                        </tr>
                    @endforeach

                    
                </tbody>
            </table>
        </div>
    </div>
</div>