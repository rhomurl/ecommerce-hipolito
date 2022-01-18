<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'id' => 1,
                'name' => 'Mondo SkimCoat 20kg',
                'slug' => 'mondo-skimcoat-20kg',
                //'s_description' => 'Smoothens masonry surface and it is resistant to hairline cracks.',
                'description' => 'Is a specially formulated free-flowing white powder to be mixed with water to form a paste that is used to fill up cracks and achieve smooth and even concrete surfaces. It is also sag resistant - perfect for ceiling, beams and other overhead applications.',
                'selling_price' => '460',
                'quantity' => '50',
                'image' => 'images/products/' . md5(1) .'.jpg',
                'category_id' => '3',
                'brand_id' => '2',
            ],
            [
                'id' => 2,
                'name' => 'Ultra Fino Skimcoat 20kg',
                'slug' => 'ultra-fino-skimcoat-20kg',
                //'s_description' => 'Good adhesion to concrete surfaces, no cracking or flaking, and no primer needed.',
                'description' => 'UltraFino Skimcoat cement-based powder for thin plastering applications. When mixed with wate, the smooth creamy consistency makes it easy to correct surface imperfections prior to painting.',
                'selling_price' => '420',
                'quantity' => '38',
                'image' => 'images/products/' . md5(2) .'.jpg',
                'category_id' => '3',
                'brand_id' => '3',
            ],
            [
                'id' => 3,
                'name' => 'Standard Brass Padlock 50mm',
                'slug' => 'standard-brass-padlock-50mm',
                //'s_description' => 'Extra security, highest quality material, and precision locking mechanism.',
                'description' => 'Extra security, highest quality material, and precision locking mechanism.',
                'selling_price' => '420',
                'quantity' => '38',
                'image' => 'images/products/' . md5(3) .'.jpg',
                'category_id' => '4',
                'brand_id' => '4',
            ],
            [
                'id' => 4,
                'name' => 'Philips LED Light Bulb 10W',
                'slug' => 'philips-led-10w',
                //'s_description' => 'Improve your home’s atmosphere with Philips high-performance and energy-saving light bulbs.',
                'description' => 'Improve your home’s atmosphere with Philips high-performance and energy-saving light bulbs.',
                'selling_price' => '159',
                'quantity' => '10',
                'image' => 'images/products/' . md5(4) .'.jpg',
                'category_id' => '2',
                'brand_id' => '5',
            ],
            [
                'id' => 5,
                'name' => 'Tokino Gas Regulator',
                'slug' => 'tokino-gas-regulator',
                //'s_description' => 'With Anti Explode Safety Feature and Adjustable Flow Control Gasul Ball Type Fitting for a more secure and easier installation. Denmark Technology and Quality Guaranteed.',
                'description' => 'With Anti Explode Safety Feature and Adjustable Flow Control Gasul Ball Type Fitting for a more secure and easier installation. Denmark Technology and Quality Guaranteed.',
                'selling_price' => '130',
                'quantity' => '5',
                'image' => 'images/products/' . md5(5) .'.jpg',
                'category_id' => '5',
                'brand_id' => '6',
            ],
            
        ];

        Product::insert($products);
    }
}
