<?php

namespace App\Http\Livewire\Shop;

use Livewire\Component;

class SearchBar extends Component
{
    public $query = "";

    public function render()
    {
        return view('livewire.shop.search-bar');
    }

    public function search()
    {
        return redirect()->route('product.search', $this->query);
    }
}
