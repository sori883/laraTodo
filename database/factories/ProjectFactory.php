<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Project;
use App\User;
use Faker\Generator as Faker;

$factory->define(Project::class, function (Faker $faker) {
    return [
        'title' => $faker->realText(10),
        'user_id' => function() {
            return factory(User::class);
        },
        'created_at' => $faker->date,
        'updated_at' => $faker->date
    ];
});
