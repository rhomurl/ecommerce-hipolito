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
        $this->total_delivery = 

        
        $addresses = AddressBook::with('barangay.city')
        ->where('id', auth()->user()->address_book_id)
        ->get();

        return view('livewire.user.account-overview', compact('addresses'))->extends('layouts.user-profile');
    }
}
