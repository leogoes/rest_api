<?php

use Faker\Generator as Faker;
use App\Product;


$factory->define(Product::class, function (Faker $faker) {
    return [
        'nome' => $faker->name,
        'price' => $faker->randomFloat(2, 0, 8),
        'description' => $faker->text,
        'created_at' => $faker->randomDigitNotNull,
        'updated_at' => $faker->randomDigitNotNull
    ];
});
