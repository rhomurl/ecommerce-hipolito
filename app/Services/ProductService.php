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

    /*
        ! : This functionality is recommended for super-admin. Will enable this once requested.
    */
    public function deleteProduct($prod){
        $product = Product::where('id', $id)->first();
        $image = $prod->image;
        if($prod->quantity > 0){
            //$this->emit("openModal", "admin.failed-modal", ["message" => 'This product cannot be deleted']); 
            $this->errorAlert('This Product Cannot Be Deleted!');
        }
        else{
            if (Storage::disk('gcs')->exists($image)) {
                Storage::disk('gcs')->delete($image);
                /*
                    Delete Multiple Files
                    Storage::delete(['upload/test.png', 'upload/test2.png']);
                */
            }
            Product::where('id', $id)->delete();
            $this->successAlert('Product Deleted Successfully!');
        } 
    }
}