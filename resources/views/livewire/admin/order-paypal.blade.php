

<x-modal>
    {{ csrf_field() }}
    <x-slot name="title">
        PayPal Order Details
    </x-slot>

    <x-slot name="content">
        <div class="px-4 py-3 mb-8 bg-white rounded-lg">
            <label class="block text-md">
                <span class="text-gray-700">
                    <b>Total amount paid:</b>
                </span>
                <span class="block w-full mt-1 text-md p-2">₱{{ $response['purchase_units'][0]['amount']['value'] }}</span>

            </label>
            <label class="block text-md">
                <span class="text-gray-700">
                    <b>PayPal Name:</b>
                </span>
                <span class="block w-full mt-1 text-md p-2">{{ $response['payer']['name']['given_name'] }} {{ $response['payer']['name']['surname'] }}</span>

            </label>
            <label class="block text-md">
                <span class="text-gray-700">
                    <b>PayPal Email:</b>
                </span>
                <span class="block w-full mt-1 text-md p-2">{{ $response['payer']['email_address'] }}</span>

            </label>

            <label class="block text-md">
                <span class="text-gray-700">
                    <b>PayPal Country:</b>
                </span>
                <span class="block w-full mt-1 text-md p-2">{{ $response['payer']['address']['country_code'] }}</span>

            </label>

            @if(isset($response['payer']['phone']['phone_number']['national_number']))
                <label class="block text-md">
                    <span class="text-gray-700">
                        <b>Mobile Number:</b>
                    </span>
                    <span class="block w-full mt-1 text-md p-2">{{ $response['payer']['phone']['phone_number']['national_number'] }}</span>
                </label>
            @endif

            <label class="block text-md">
                <span class="text-gray-700">
                    <b>Shipping Address:</b>
                </span>
                <span class="block w-full mt-1 text-md p-2">{{ $response['purchase_units'][0]['shipping']['address']['address_line_1'] }}, {{ $response['purchase_units'][0]['shipping']['address']['address_line_2'] }}, {{ $response['purchase_units'][0]['shipping']['address']['admin_area_2'] }}, {{ $response['purchase_units'][0]['shipping']['address']['admin_area_1'] }}, {{ $response['purchase_units'][0]['shipping']['address']['postal_code'] }}</span>

            </label>
        </div>
        
        {{--
            <label class="block text-sm">
                <span class="text-gray-700">
                    <b>Name</b>
                </span>
                <span class="block w-full mt-1 text-sm p-2">{{ $this->user->name }}</span>

            </label>

            <label class="block mt-4 text-sm">
                <span class="text-gray-700">
                    <b>Email</b>
                </span>
                <span class="block w-full mt-1 text-sm p-2">{{ $this->user->email }}</span>
            </label>

            <label class="block mt-4 text-sm">
                <span class="text-gray-700">
                    <b>Login Method</b>
                </span>
                <input type="text" value="@if($this->user->provider == 'google') Google
                @elseif($this->user->provider == 'facebook') Facebook
                @else Website @endif" 
                class="block w-full mt-1 text-sm border-none rounded appearance-none p-2" disabled>
            </label>

            <label class="block mt-4 text-sm">
                <span class="text-gray-700">
                    <b>Last Order</b>
                </span>
                <span class="block w-full mt-1 text-sm p-2">@if($this->last_order) {{ $this->last_order->created_at->diffForHumans() }}
                @else No Data @endif</span>
               
            </label>

            <label class="block mt-4 text-sm">
                <span class="text-gray-700">
                    <b>Pending Orders ({{ $this->pending_orders->count() }})</b>
                </span>
            </label>
            @forelse($this->pending_orders as $pending_order)
                <a target="_blank" href="{{ route('admin.order.details', $pending_order->id) }}" class="block w-full text-sm p-1 hover:text-blue-600 ">Order #{{ $pending_order->id }}</a>
            @empty
                <span class="block w-full mt-1 text-sm p-2">No Pending Orders</span>
            @endforelse

            
        </div>--}}
    </x-slot>

    <x-slot name="buttons">
        <button wire:click.prevent="$emit('closeModal')" class="w-full px-5 py-3 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray">
            Close
        </button>
    </x-slot>
</x-modal>