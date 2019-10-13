<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    $pesos = $faker->randomNumber(2);
    $cents = $faker->randomNumber(2,true);
    return [
        "name" => $faker->name,
        "price" => "${pesos}.${cents}"
    ];
});
