<?php

namespace App\Http\Livewire\Shop;

use Livewire\Component;

class CheckoutSuccess extends Component
{
    public function mount($orderid)
    {
        $this->order_id = $orderid;
    }

    public function render()
    {
        return view('livewire.shop.checkout-success');
    }
}
