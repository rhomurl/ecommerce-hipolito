<?php

namespace App\Http\Livewire\Shop;

use Livewire\Component;

class FAQ extends Component
{
    public function render()
    {
        return view('livewire.shop.f-a-q')->layout('layouts.user');
    }
}
