<?php
//New Code .edj


use Faker\Generator as Faker;
use App\Business;

$factory->define(Business::class, function (Faker $faker) {
    return [
        'businessName' => $faker->company,
    ];
});
