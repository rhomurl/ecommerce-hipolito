<?php

namespace App\Services;

use Illuminate\Support\Str;
use App\Models\Product;

class ProductService {

    public function store($name)
    {
        $this->checkSlug($name);
        $product = Product::create([
            'name' => $name, 
            'slug' => $this->slug,
        ]);
        return $product;
    }

    /*public function edit($id, $name)
    {

        $this->checkSlug($name);
        $category = Category::updateOrCreate(['id' => $id],
            [
                'name' => $name,
                'slug' => $this->slug,
            ]
        );
        return $category;
    }*/

    public function checkSlug($name){
        $slug = Str::slug($name);
        $numSlugs = Category::where('slug', 'regexp', '^'.$slug.'(-[0-9])?')->count();
        
        if($numSlugs== 0) {
            $slug = $slug;
        }else{
            $slug = $slug.'-'.$numSlugs;
        }
        $this->slug = $slug;
    }
}