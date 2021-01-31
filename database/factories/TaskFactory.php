<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Task;
use App\User;
use App\Project;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
    return [
        'title' => $faker->realText(20),
        'status' => now(),
        'limit_at' => $faker->date,
        'user_id' => function() {
            return factory(User::class);
        },
        'project_id' => function() {
            return factory(Project::class);
        },
        'created_at' => $faker->date,
        'updated_at' => $faker->date
    ];
});
