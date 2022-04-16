<?php

namespace App\Http\Livewire\Components;

use App\Models\Category;
use Livewire\Component;

class HeaderCategories extends Component
{
    public function render()
    {
        $categories = Category::limit(7)->orderBy('name', 'ASC')->get();
        return view('livewire.components.header-categories', compact('categories'));
    }
}
