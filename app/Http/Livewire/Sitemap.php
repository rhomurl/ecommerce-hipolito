<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Brand;
use Livewire\Component;

class Sitemap extends Component
{
    public function render()
    {
        $categories = Category::select('name','slug')->get();
        $brands = Brand::select('name','slug')->get();

        return view('livewire.sitemap', compact('categories', 'brands'));
    }
}
