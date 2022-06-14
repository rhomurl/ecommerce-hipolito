<?php

namespace App\Http\Livewire\Admin;

use App\Services\OrderPaypalService;
use LivewireUI\Modal\ModalComponent;

class OrderPaypal extends ModalComponent
{
    public function mount($id){
        $this->id = $id;
    }
    public function render(OrderPaypalService $order)
    {
        $response = $order->getPaypalDetails($this->id);

        return view('livewire.admin.order-paypal', compact('response'));
    }
}
