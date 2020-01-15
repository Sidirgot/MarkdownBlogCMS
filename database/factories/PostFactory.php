<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Carbon\Carbon;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'slug' =>  Str::slug($faker->sentence,'-'),
        'title' => $faker->sentence,
        'content' => $faker->text($maxNbChars = 5000) ,
    ];
});
