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
            {{ $order->getOrderStatusAttribute() }}
        </p>
    </td>

    <td class="px-4 py-3">
        <p class="font-semibold">
            @if($order->admin_id)
                {{ $this->getAdminName($order->admin_id) }}
            @else
                Not Yet Processed
            @endif
        </p>
    </td>

    <td class="px-4 py-3">
        <div class="flex items-center space-x-4 text-sm">
            <a href="{{ route('admin.order.details', $order->id ) }}" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" aria-label="Edit">
                View Order
            </a>
                @if($order->status != 'cancelled' && $order->status != 'pending')
                <div class="my-2 px-2">
                    <a href="{{ route('admin.genOrderPDF', $order->uuid) }}" target="_blank" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Generate Invoice
                    </a>
                </div>
                @endif
        </div>
    </td>
    
</tr>