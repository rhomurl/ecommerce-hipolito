<?php

namespace App\Http\Livewire\Shop;

use Livewire\Component;

class AboutUs extends Component
{
    public function render()
    {
        return view('livewire.shop.about-us')->layout('layouts.user');
    }
}
