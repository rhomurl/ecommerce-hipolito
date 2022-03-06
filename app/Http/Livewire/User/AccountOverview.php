<?php

namespace App\Http\Livewire\User;

use App\Models\Order;
use App\Models\AddressBook;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AccountOverview extends Component
{
    protected $listeners = ['updateComponent' => 'render'];
    

    public function render()
    {
        $this->order_count = Order::where('user_id', Auth::id())->count();
        $this->order_processing_count = Order::where('user_id', Auth::id())
            ->where('status', 'ordered')
            ->count();

        $addresses = AddressBook::with('barangay.city')
        ->where('user_id', Auth::id())
        ->limit(1)
        ->get();

        return view('livewire.user.account-overview', compact('addresses'))->extends('layouts.user-profile');
    }
}
