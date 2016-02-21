<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Repository::class, function (Faker\Generator $faker) {
    return [
        'github_id' => $faker->randomNumber(8),
        'status' => $faker->randomElement(['new', 'synced', 'syncing', 'deleted']),
        'enabled' => $faker->boolean(90)
    ];
});
