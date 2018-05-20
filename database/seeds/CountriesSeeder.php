<?php

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $value = include 'data/countriesData.php';

        foreach ($value as $item) {
            Country::create(['name' => $item]);
        }
    }
}
