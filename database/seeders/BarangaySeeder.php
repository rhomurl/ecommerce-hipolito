<?php

namespace Database\Seeders;

use App\Models\Barangay;
use Illuminate\Database\Seeder;

class BarangaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
  public function run()
  {
    $city_id_lipa = 41014;
    $city_id_tanauan = 41031;
    $barangay = [
      //Lipa Barangays
      [
        'city_id' => $city_id_lipa,
        'shippingfee' => 0,
        'name' => 'Adya',
      ],
      [
        'city_id' => $city_id_lipa,
        'shippingfee' => 0,
        'name' => 'Anilao',
      ],
      [
        'city_id' => $city_id_lipa,
        'shippingfee' => 0,
        'name' => 'Anilao-Labac',
      ],
      [
        'city_id' => $city_id_lipa,
        'shippingfee' => 0,
        'name' => 'Antipolo Del Norte',
      ],
      [
        'city_id' => $city_id_lipa,
        'shippingfee' => 0,
        'name' => 'Antipolo Del Sur',
      ],
      [
        'city_id' => $city_id_lipa,
        'shippingfee' => 0,
        'name' => 'Bagong Pook',
      ],
      [
        'city_id' => $city_id_lipa,
        'shippingfee' => 0,
        'name' => 'San Sebastian',
      ],
      [
        'city_id' => $city_id_lipa,
        'shippingfee' => 0,
        'name' => 'Balintawak',
      ],
      [
        'city_id' => $city_id_lipa,
        'shippingfee' => 0,
        'name' => 'Banaybanay',
      ],
      [
        'city_id' => $city_id_lipa,
        'shippingfee' => 0,
        'name' => 'Bolbok',
      ],
      [
        'city_id' => $city_id_lipa,
        'shippingfee' => 0,
        'name' => 'Bugtong na Pulo',
      ],
      [
        'city_id' => $city_id_lipa,
        'shippingfee' => 0,
        'name' => 'Bulacnin',
      ],
      [
        'city_id' => $city_id_lipa,
        'shippingfee' => 0,
        'name' => 'Bulaklakan',
      ],
      [
        'city_id' => $city_id_lipa,
        'shippingfee' => 0,
        'name' => 'Calamias',
      ],
      [
        'city_id' => $city_id_lipa,
        'shippingfee' => 0,
        'name' => 'Cumba',
      ],
      [
        'city_id' => $city_id_lipa,
        'shippingfee' => 0,
        'name' => 'Dagatan',
      ],
      [
        'city_id' => $city_id_lipa,
        'shippingfee' => 0,
        'name' => 'Duhatan',
      ],
      [
        'city_id' => $city_id_lipa,
        'shippingfee' => 0,
        'name' => 'Halang',
      ],
      [
        'city_id' => $city_id_lipa,
        'shippingfee' => 0,
        'name' => 'Inosloban',
      ],
      [
        'city_id' => $city_id_lipa,
        'shippingfee' => 0,
        'name' => 'Kayumanggi',
      ],
      [
        'city_id' => $city_id_lipa,
        'shippingfee' => 0,
        'name' => 'Latag',
      ],
      [
        'city_id' => $city_id_lipa,
        'shippingfee' => 0,
        'name' => 'Lodlod',
      ],
      [
        'city_id' => $city_id_lipa,
        'shippingfee' => 0,
        'name' => 'Lumbang',
      ],
      [
        'city_id' => $city_id_lipa,
        'shippingfee' => 0,
        'name' => 'Mabini',
      ],
      [
        'city_id' => $city_id_lipa,
        'shippingfee' => 0,
        'name' => 'Malagonlong',
      ],
      [
        'city_id' => $city_id_lipa,
        'shippingfee' => 0,
        'name' => 'Malitlit',
      ],
      [
        'city_id' => $city_id_lipa,
        'shippingfee' => 0,
        'name' => 'Marauoy',
      ],
      [
        'city_id' => $city_id_lipa,
        'shippingfee' => 0,
        'name' => 'Mataas Na Lupa',
      ],
      [
        'city_id' => $city_id_lipa,
        'shippingfee' => 0,
        'name' => 'Munting Pulo',
      ],
      [
        'city_id' => $city_id_lipa,
        'shippingfee' => 0,
        'name' => 'Pagolingin Bata',
      ],
      [
        'city_id' => $city_id_lipa,
        'shippingfee' => 0,
        'name' => 'Pagolingin East',
      ],
      [
        'city_id' => $city_id_lipa,
        'shippingfee' => 0,
        'name' => 'Pagolingin West',
      ],
      [
        'city_id' => $city_id_lipa,
        'shippingfee' => 0,
        'name' => 'Pangao',
      ],
      [
        'city_id' => $city_id_lipa,
        'shippingfee' => 0,
        'name' => 'Pinagkawitan',
      ],
      [
        'city_id' => $city_id_lipa,
        'shippingfee' => 0,
        'name' => 'Pinagtongulan',
      ],
      [
        'city_id' => $city_id_lipa,
        'shippingfee' => 0,
        'name' => 'Plaridel',
      ],
      [
        'city_id' => $city_id_lipa,
        'shippingfee' => 0,
        'name' => 'Poblacion Barangay 1',
      ],
      [
        'city_id' => $city_id_lipa,
        'shippingfee' => 0,
        'name' => 'Poblacion Barangay 10',
      ],
      [
        'city_id' => $city_id_lipa,
        'shippingfee' => 0,
        'name' => 'Poblacion Barangay 11',
      ],
      [
        'city_id' => $city_id_lipa,
        'shippingfee' => 0,
        'name' => 'Poblacion Barangay 2',
      ],
      [
        'city_id' => $city_id_lipa,
        'shippingfee' => 0,
        'name' => 'Poblacion Barangay 3',
      ],
      [
        'city_id' => $city_id_lipa,
        'shippingfee' => 0,
        'name' => 'Poblacion Barangay 4',
      ],
      [
        'city_id' => $city_id_lipa,
        'shippingfee' => 0,
        'name' => 'Poblacion Barangay 5',
      ],
      [
        'city_id' => $city_id_lipa,
        'shippingfee' => 0,
        'name' => 'Poblacion Barangay 6',
      ],
      [
        'city_id' => $city_id_lipa,
        'shippingfee' => 0,
        'name' => 'Poblacion Barangay 7',
      ],
      [
        'city_id' => $city_id_lipa,
        'shippingfee' => 0,
        'name' => 'Poblacion Barangay 8',
      ],
      [
        'city_id' => $city_id_lipa,
        'shippingfee' => 0,
        'name' => 'Poblacion Barangay 9',
      ],
      [
        'city_id' => $city_id_lipa,
        'shippingfee' => 0,
        'name' => 'Pusil',
      ],
      [
        'city_id' => $city_id_lipa,
        'shippingfee' => 0,
        'name' => 'Quezon',
      ],
      [
        'city_id' => $city_id_lipa,
        'shippingfee' => 0,
        'name' => 'Rizal',
      ],
      [
        'city_id' => $city_id_lipa,
        'shippingfee' => 0,
        'name' => 'Sabang',
      ],
      [
        'city_id' => $city_id_lipa,
        'shippingfee' => 0,
        'name' => 'Sampaguita',
      ],
      [
        'city_id' => $city_id_lipa,
        'shippingfee' => 0,
        'name' => 'San Benito',
      ],
      [
        'city_id' => $city_id_lipa,
        'shippingfee' => 0,
        'name' => 'San Carlos',
      ],
      [
        'city_id' => $city_id_lipa,
        'shippingfee' => 0,
        'name' => 'San Celestino',
      ],
      [
        'city_id' => $city_id_lipa,
        'shippingfee' => 0,
        'name' => 'San Francisco',
      ],
      [
        'city_id' => $city_id_lipa,
        'shippingfee' => 0,
        'name' => 'San Guillermo',
      ],
      [
        'city_id' => $city_id_lipa,
        'shippingfee' => 0,
        'name' => 'San Jose',
      ],
      [
        'city_id' => $city_id_lipa,
        'shippingfee' => 0,
        'name' => 'San Lucas',
      ],
      [
        'city_id' => $city_id_lipa,
        'shippingfee' => 0,
        'name' => 'San Salvador',
      ],
      [
        'city_id' => $city_id_lipa,
        'shippingfee' => 0,
        'name' => 'Sapac',
      ],
      [
        'city_id' => $city_id_lipa,
        'shippingfee' => 0,
        'name' => 'Sico',
      ],
      [
        'city_id' => $city_id_lipa,
        'shippingfee' => 0,
        'name' => 'Santo Niño',
      ],
      [
        'city_id' => $city_id_lipa,
        'shippingfee' => 0,
        'name' => 'Santo Toribio',
      ],
      [
        'city_id' => $city_id_lipa,
        'shippingfee' => 0,
        'name' => 'Talisay',
      ],
      [
        'city_id' => $city_id_lipa,
        'shippingfee' => 0,
        'name' => 'Tambo',
      ],
      [
        'city_id' => $city_id_lipa,
        'shippingfee' => 0,
        'name' => 'Tangob',
      ],
      [
        'city_id' => $city_id_lipa,
        'shippingfee' => 0,
        'name' => 'Tanguay',
      ],
      [
        'city_id' => $city_id_lipa,
        'shippingfee' => 0,
        'name' => 'Tibig',
      ],
      [
        'city_id' => $city_id_lipa,
        'shippingfee' => 0,
        'name' => 'Tipacan',
      ],
      [
        'city_id' => $city_id_lipa,
        'shippingfee' => 0,
        'name' => 'Poblacion Barangay 9-A',
      ],
      [
        'city_id' => $city_id_lipa,
        'shippingfee' => 0,
        'name' => 'Barangay 12 (Pob.)',
      ],

      //Tanauan Barangay
      [
        'city_id' => $city_id_tanauan,
        'name' => 'Altura Bata',
        'shippingfee' => '0'
      ],
      [
        'city_id' => $city_id_tanauan,
        'name' => 'Altura Matanda',
        'shippingfee' => '0'
      ],
      [
        'city_id' => $city_id_tanauan,
        'name' => 'Altura-South',
        'shippingfee' => '0'
      ],
      [
        'city_id' => $city_id_tanauan,
        'name' => 'Ambulong',
        'shippingfee' => '0'
      ],
      [
        'city_id' => $city_id_tanauan,
        'name' => 'Banadero',
        'shippingfee' => '0'
      ],
      [
        'city_id' => $city_id_tanauan,
        'name' => 'Bagbag',
        'shippingfee' => '0'
      ],
      [
        'city_id' => $city_id_tanauan,
        'name' => 'Bagumbayan',
        'shippingfee' => '0'
      ],
      [
        'city_id' => $city_id_tanauan,
        'name' => 'Balele',
        'shippingfee' => '0'
      ],
      [
        'city_id' => $city_id_tanauan,
        'name' => 'Banjo East',
        'shippingfee' => '0'
      ],
      [
        'city_id' => $city_id_tanauan,
        'name' => 'Banjo Laurel',
        'shippingfee' => '0'
      ],
      [
        'city_id' => $city_id_tanauan,
        'name' => 'Bilog-bilog',
        'shippingfee' => '0'
      ],
      [
        'city_id' => $city_id_tanauan,
        'name' => 'Boot',
        'shippingfee' => '0'
      ],
      [
        'city_id' => $city_id_tanauan,
        'name' => 'Cale',
        'shippingfee' => '0'
      ],
      [
        'city_id' => $city_id_tanauan,
        'name' => 'Darasa',
        'shippingfee' => '0'
      ],
      [
        'city_id' => $city_id_tanauan,
        'name' => 'Pagaspas',
        'shippingfee' => '0'
      ],
      [
        'city_id' => $city_id_tanauan,
        'name' => 'Gonzales',
        'shippingfee' => '0'
      ],
      [
        'city_id' => $city_id_tanauan,
        'name' => 'Hidalgo',
        'shippingfee' => '0'
      ],
      [
        'city_id' => $city_id_tanauan,
        'name' => 'Janopol',
        'shippingfee' => '0'
      ],
      [
        'city_id' => $city_id_tanauan,
        'name' => 'Janopol Oriental',
        'shippingfee' => '0'
      ],
      [
        'city_id' => $city_id_tanauan,
        'name' => 'Laurel',
        'shippingfee' => '0'
      ],
      [
        'city_id' => $city_id_tanauan,
        'name' => 'Luyos',
        'shippingfee' => '0'
      ],
      [
        'city_id' => $city_id_tanauan,
        'name' => 'Mabini',
        'shippingfee' => '0'
      ],
      [
        'city_id' => $city_id_tanauan,
        'name' => 'Malaking Pulo',
        'shippingfee' => '0'
      ],
      [
        'city_id' => $city_id_tanauan,
        'name' => 'Maria Paz',
        'shippingfee' => '0'
      ],
      [
        'city_id' => $city_id_tanauan,
        'name' => 'Maugat',
        'shippingfee' => '0'
      ],
      [
        'city_id' => $city_id_tanauan,
        'name' => 'Montaña',
        'shippingfee' => '0'
      ],
      [
        'city_id' => $city_id_tanauan,
        'name' => 'Natatas',
        'shippingfee' => '0'
      ],
      [
        'city_id' => $city_id_tanauan,
        'name' => 'Pantay Matanda',
        'shippingfee' => '0'
      ],
      [
        'city_id' => $city_id_tanauan,
        'name' => 'Pantay Bata',
        'shippingfee' => '0'
      ],
      [
        'city_id' => $city_id_tanauan,
        'name' => 'Poblacion Barangay 1',
        'shippingfee' => '0'
      ],
      [
        'city_id' => $city_id_tanauan,
        'name' => 'Poblacion Barangay 2',
        'shippingfee' => '0'
      ],
      [
        'city_id' => $city_id_tanauan,
        'name' => 'Poblacion Barangay 3',
        'shippingfee' => '0'
      ],
      [
        'city_id' => $city_id_tanauan,
        'name' => 'Poblacion Barangay 4',
        'shippingfee' => '0'
      ],
      [
        'city_id' => $city_id_tanauan,
        'name' => 'Poblacion Barangay 5',
        'shippingfee' => '0'
      ],
      [
        'city_id' => $city_id_tanauan,
        'name' => 'Poblacion Barangay 6',
        'shippingfee' => '0'
      ],
      [
        'city_id' => $city_id_tanauan,
        'name' => 'Poblacion Barangay 7',
        'shippingfee' => '0'
      ],
      [
        'city_id' => $city_id_tanauan,
        'name' => 'Sala',
        'shippingfee' => '0'
      ],
      [
        'city_id' => $city_id_tanauan,
        'name' => 'Sambat',
        'shippingfee' => '0'
      ],
      [
        'city_id' => $city_id_tanauan,
        'name' => 'San Jose',
        'shippingfee' => '0'
      ],
      [
        'city_id' => $city_id_tanauan,
        'name' => 'Santol',
        'shippingfee' => '0'
      ],
      [
        'city_id' => $city_id_tanauan,
        'name' => 'Santor',
        'shippingfee' => '0'
      ],
      [
        'city_id' => $city_id_tanauan,
        'name' => 'Sulpoc',
        'shippingfee' => '0'
      ],
      [
        'city_id' => $city_id_tanauan,
        'name' => 'Suplang',
        'shippingfee' => '0'
      ],
      [
        'city_id' => $city_id_tanauan,
        'name' => 'Talaga',
        'shippingfee' => '0'
      ],
      [
        'city_id' => $city_id_tanauan,
        'name' => 'Tinurik',
        'shippingfee' => '0'
      ],
      [
        'city_id' => $city_id_tanauan,
        'name' => 'Trapiche',
        'shippingfee' => '0'
      ],
      [
        'city_id' => $city_id_tanauan,
        'name' => 'Ulango',
        'shippingfee' => '0'
      ],
      [
        'city_id' => $city_id_tanauan,
        'name' => 'Wawa',
        'shippingfee' => '0'
      ]
    ];
    Barangay::insert($barangay);
  }
}
