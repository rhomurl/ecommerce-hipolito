<?php

namespace App\Http\Livewire\Shop;

use Livewire\Component;

class ShippingPolicy extends Component
{
    public function render()
    {
        return view('livewire.shop.shipping-policy')->layout('layouts.user');
    }
}
