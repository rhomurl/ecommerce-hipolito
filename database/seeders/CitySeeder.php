<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $city = [
            [
                'id' => 41014,
                'name' => 'Lipa City',
                'zip' => '4217',
            ],
        ];
    }
}
