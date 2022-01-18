<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = [
            [
                'id' => 1,
                'name' => 'Paint',
                'slug' => 'paint',
            ],
            [
                'id' => 2,
                'name' => 'Light Bulb',
                'slug' => 'light-bulb',
            ],
            [
                'id' => 3,
                'name' => 'Skimcoat',
                'slug' => 'skimcoat',
            ],
            [
                'id' => 4,
                'name' => 'Fittings',
                'slug' => 'fittings',
            ],
            [
                'id' => 5,
                'name' => 'LPG Hose',
                'slug' => 'lpg-hose',
            ],
        ];

        Category::insert($category);
    }
}
