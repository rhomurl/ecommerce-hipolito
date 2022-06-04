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
                //'id' => 1,
                'name' => 'Firefly',
                'slug' => 'firefly',
            ],
            [
                //'id' => 2,
                'name' => 'Davies',
                'slug' => 'davies',
            ],
            [
                //'id' => 3,
                'name' => 'Bostik',
                'slug' => 'bostik',
            ],
            [
                //'id' => 4,
                'name' => 'Stanley',
                'slug' => 'stanley',
            ],
            [
                //'id' => 5,
                'name' => 'Philips',
                'slug' => 'philips',
            ],
            [
                //'id' => 6,
                'name' => 'Tokino',
                'slug' => 'tokino',
            ],
            [
                //'id' => 7,
                'name' => 'Syc marine',
                'slug' => 'syc-marine',
            ],
            [
                //'id' => 8,
                'name' => 'Neltex',
                'slug' => 'neltex',
            ],
            [
                //'id' => 9,
                'name' => 'Atlanta',
                'slug' => 'atlanta',
            ],
            [
                //'id' => 10,
                'name' => 'Alasco',
                'slug' => 'alasco',
            ],
            [
                //'id' => 11,
                'name' => 'Omni',
                'slug' => 'omni',
            ],
            [
                //'id' => 12,
                'name' => 'Royou Electrical',
                'slug' => 'royou-electrical',
            ],
            [
                //'id' => 13,
                'name' => 'Stikwel',
                'slug' => 'stikwel',
            ],
            [
                //'id' => 14,
                'name' => 'Coolant',
                'slug' => 'coolant',
            ],
            [
                //'id' => 15,
                'name' => 'Deformed Bar',
                'slug' => 'deformed-bar',
            ],
            [
                //'id' => 16,
                'name' => 'Republic',
                'slug' => 'republic',
            ],
            [
                //'id' => 17,
                'name' => 'Yale',
                'slug' => 'yale',
            ],
            [
                //'id' => 18,
                'name' => 'No Brand',
                'slug' => 'no-brand',
            ],
            [
                //'id' => 19,
                'name' => 'Asea',
                'slug' => 'asea',
            ],
            [
                //'id' => 20,
                'name' => 'Yamato',
                'slug' => 'yamato',
            ],
            [
                //'id' => 21,
                'name' => 'Powerhouse',
                'slug' => 'powerhouse',
            ],
            [
                //'id' => 22,
                'name' => 'Boysen',
                'slug' => 'boysen',
            ],
        ];

        Brand::insert($brand);
    }
}
