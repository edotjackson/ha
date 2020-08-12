<?php
//New Code .edj


use App\City;
use Faker\Generator as Faker;

$factory->define(App\City::class, function (Faker $faker) {
    return [
        //Fake names of people as cities
        'name' =>  $faker->firstName,
        //lat/lon within Colorado bounds
        'lat' => $faker->randomFloat(6, 36.993077, 41.000644),
        'lon' => $faker->randomFloat(6, -109.050063, -102,042207)
    ];
});
