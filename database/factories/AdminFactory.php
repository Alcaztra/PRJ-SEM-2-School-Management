<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(App\Admin::class, function (Faker $faker) {
    return [
        'user_id' => 'Admin' . $faker->unique()->randomNumber(3),
        'name' => $faker->name,
        'gender' => $faker->randomElement(['male','female','other']),
        'email' => $faker->email,
        'phone' => $faker->phoneNumber,
        'birthday' => $faker->date(),
        'address' => $faker->address,
        'remember_token' => Str::random(10),
    ];
});
