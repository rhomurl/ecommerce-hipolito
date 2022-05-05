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
                //'id' => 1,
                'name' => 'Paint',
                'slug' => 'paint',
            ],
            [
                //'id' => 2,
                'name' => 'Light Bulb',
                'slug' => 'light-bulb',
            ],
            [
                //'id' => 3,
                'name' => 'Skimcoat',
                'slug' => 'skimcoat',
            ],
            [
                //'id' => 4,
                'name' => 'Fittings',
                'slug' => 'fittings',
            ],
            [
                //'id' => 5,
                'name' => 'LPG Hose',
                'slug' => 'lpg-hose',
            ],
            [
                //'id' => 6,
                'name' => 'Plywood',
                'slug' => 'plywood',
            ],
            [
                //'id' => 7,
                'name' => 'Steel',
                'slug' => 'steel',
            ],
            [
                //'id' => 8,
                'name' => 'Cement',
                'slug' => 'cement',
            ],
            [
                //'id' => 9,
                'name' => 'Door',
                'slug' => 'door',
            ],
            [
                //'id' => 10,
                'name' => 'Construction Equipment',
                'slug' => 'construction-equipment',
            ],
        ];

        Category::insert($category);
    }
}
