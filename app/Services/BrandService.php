<?php

namespace App\Services;

use Illuminate\Support\Str;
use App\Models\Brand;

class BrandService {

    public function store($name)
    {
        $this->checkSlug($name);
        $brand = Brand::create([
            'name' => $name, 
            'slug' => $this->slug,
        ]);
        return $brand;
    }

    public function edit($id, $name)
    {

        $this->checkSlug($name);
        $brand = Brand::updateOrCreate(['id' => $id],
            [
                'name' => $name,
                'slug' => $this->slug,
            ]
        );
        return $brand;
    }

    public function checkSlug($name){
        $slug = Str::slug($name);
        $numSlugs = Brand::where('slug', 'regexp', '^'.$slug.'(-[0-9])?')->count();
        
        if($numSlugs== 0) {
            $slug = $slug;
        }else{
            $slug = $slug.'-'.$numSlugs;
        }
        $this->slug = $slug;
    }
}