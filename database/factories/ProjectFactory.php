<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Project;
use Faker\Generator as Faker;

$factory->define(Project::class, function (Faker $faker) {
    return [
        'title' => $faker->text,
        'user_id' => 1,
        'created_at' => $faker->date,
        'updated_at' => $faker->date
    ];
});
