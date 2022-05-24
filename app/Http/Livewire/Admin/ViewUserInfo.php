<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use App\Models\Order;

use LivewireUI\Modal\ModalComponent;

class ViewUserInfo extends ModalComponent
{
    public function mount($id)
    {
        $this->user = User::role('customer')
            ->where('id', $id)
            ->first();
        
        $this->last_order = Order::select('created_at')
            ->where('user_id', $id)
            ->orderBy('created_at', 'DESC')
            ->first();

        $this->pending_orders = Order::select('id')
            ->where(['user_id' => $id, 'status' => 'ordered'])
            ->get();
    }

    public function render()
    {
        return view('livewire.admin.view-user-info');
    }
}
