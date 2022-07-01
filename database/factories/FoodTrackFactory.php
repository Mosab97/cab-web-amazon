<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Models\FoodTrack;

$factory->define(FoodTrack::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->paragraph,
        'rate' => $faker->numberBetween(1,10),
    ];
});
