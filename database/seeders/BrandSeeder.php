<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brand = [
            [
                'id' => 1,
                'name' => 'Firefly',
                'slug' => 'Firefly',
            ],
            [
                'id' => 2,
                'name' => 'Davies',
                'slug' => 'davies',
            ],
            [
                'id' => 3,
                'name' => 'Bostik',
                'slug' => 'bostik',
            ],
            [
                'id' => 4,
                'name' => 'Stanley',
                'slug' => 'stanley',
            ],
            [
                'id' => 5,
                'name' => 'Philips',
                'slug' => 'philips',
            ],
            [
                'id' => 6,
                'name' => 'Tokino',
                'slug' => 'tokino',
            ],
        ];

        Brand::insert($brand);
    }
}
