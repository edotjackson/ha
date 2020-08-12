<?php
//New Code .edj


use App\Address;
use Faker\Generator as Faker;

$factory->define(Address::class, function (Faker $faker) {
    return [
        'addressLine1' => $faker->streetAddress,
        'city' => $faker->city,
        'stateAbbr' => $faker->state,
        'postal' => $faker->postcode
    ];
});
