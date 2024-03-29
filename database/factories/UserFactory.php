<?php

use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User_app::class, function (Faker $faker) {
    static $password;
    return [
        'name' => $faker->name,
		'email' => $faker->unique()->safeEmail,
		'user_type' => 'ar',
		'email_verified_at' => now(),
		'password' => $password ?: $password = bcrypt('secret'),
		'remember_token' => str_random(10),
    ];
});
