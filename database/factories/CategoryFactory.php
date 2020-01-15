<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'icon' => $faker->imageUrl(40, 40),
        'color' => $faker->hexColor,
    ];
});
