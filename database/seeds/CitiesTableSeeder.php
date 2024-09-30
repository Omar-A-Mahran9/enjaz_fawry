<?php

use Illuminate\Database\Seeder;
use App\City;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $city = new City;
        $city->name = 'الرياض';
        $city->save();


        $city2 = new City;
        $city2->name = 'جدة';
        $city2->save();


        $city3 = new City;
        $city3->name = 'الدمام';
        $city3->save();


    }
}
