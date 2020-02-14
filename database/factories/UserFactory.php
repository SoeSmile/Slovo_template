<?php

/** @var Factory $factory */

use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

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

$factory->define(User::class, function (Faker $faker) {
    return [
        'login'          => $faker->name,
        'email'          => $faker->unique()->safeEmail,
        'confirm'        => true,
        'password'       => bcrypt('123456'),
        'time_zone'      => 3,
        'role_type'      => $faker->randomElement(['super_admin', 'admin', 'new', 'gl_re']),
    ];
});
