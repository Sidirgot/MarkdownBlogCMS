<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\SocialMedia;
use Faker\Generator as Faker;

$factory->define(SocialMedia::class, function (Faker $faker) {
    return [
        'personal_account_url' => $faker->url,
        'social_share_url' => $faker->url,
        'social_name' => $faker->userName,
        'social_icon' =>  $faker->name,
        'sharable' => true
    ];
});
