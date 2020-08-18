<?php

use App\Country;
use Illuminate\Database\Seeder;

class CountryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $JsonFileCountriesString = file_get_contents("countries_db.json", true);
        $countries = json_decode($JsonFileCountriesString);

        foreach($countries as $c){
            $country = new Country;
            $country->name = $c->country;
            $country->abbr = $c->abbreviation;
            $country->continent = $c->continent;
            $country->city = $c->city;
            $country->currency = $c->name;
            $country->symbol = $c->code;
            $country->save();
        }
    }
}
