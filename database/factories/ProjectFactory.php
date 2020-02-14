<?php
declare(strict_types=1);

/** @var Factory $factory */

use App\Models\Project;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Project::class, static function (Faker $faker) {
    return [
        'name'    => $faker->text(150),
        'user_id' => $faker->randomElement(['fc2150e4-5127-4add-bad0-2394add2c060', $faker->uuid]),
        'note'    => $faker->text,
        'url'     => $faker->url,
        'data'    => [
            'preview' => $faker->boolean
        ]
    ];
});
