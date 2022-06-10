<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Banner;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $banner = [
            [
                'name' => 'Banner 1',
                'image' => 'images/banners/banner_5416b593568e8345f0ad88d15e57d61e65f1f01f.jpg',
            ],
            [
                'name' => 'Banner 2',
                'image' => 'images/banners/banner_e75b575a1029aa802b658433436f8abd0b59d801.jpg',
            ]
        ];

        Banner::insert($banner);

    }
}
