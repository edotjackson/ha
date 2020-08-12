<?php
//New Code .edj


use App\Review;
use Faker\Generator as Faker;

$factory->define(App\Review::class, function (Faker $faker) {
    return [
        'ratingScore' => $faker->randomFloat(1, 2, 5),
        'customerComment' => $faker->text()
    ];
});
