<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(App\Admin::class, function (Faker $faker) {
    return [
        'user_id' => 'Admin' . $faker->unique()->randomNumber(3),
        'name' => $faker->name,
        'gender' => $faker->randomKey(['male', 'female', 'other']),
        'email' => $faker->email,
        'phone' => $faker->phoneNumber,
        'birthday' => $faker->dateTimeThisDecade,
        'address' => $faker->address,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});
