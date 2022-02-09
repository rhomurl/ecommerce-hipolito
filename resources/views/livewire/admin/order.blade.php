<tr class="text-gray-700 dark:text-gray-400">
    <td class="px-4 py-3">
        <div class="flex items-center text-sm">
            <!-- Avatar with inset shadow -->
            <div>
                <p class="font-semibold">Order #{{ $order->id }}</p>
                
            </div>
        </div>
    </td>
    
    <td class="px-4 py-3">
        <div class="flex items-center text-sm">
            <!-- Avatar with inset shadow -->
            <div>
                <p class="font-semibold"> {{ $order->user->name  }} </p>
            </div>
        </div>
    </td>

    <td class="px-4 py-3">
        <p class="font-semibold">₱ {{ $order->total }}</p>
    </td>

    <td class="px-4 py-3">
        <p class="font-semibold">
            @if($order->status == 'ordered')
                Ordered
            @elseif($order->status == 'delivered')
                Delivered
            @elseif($order->status == 'otw')
                On The Way
            @elseif($order->status == 'processing')
                Processing    
            @else
                {{ $order->status }}
            @endif
        </p>
    </td>

    <td class="px-4 py-3">
        <a href="{{ route('admin.order.details', $order->id ) }}" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">View Order</a>
    </td>
</tr>