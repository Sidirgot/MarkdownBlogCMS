<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Subscriber;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Subscriber::class, function (Faker $faker) {
    $email = $faker->email;

    return [
        'email' => $email,
        'token' => Str::limit(md5($email . Str::random()),30,'')
    ];
});
