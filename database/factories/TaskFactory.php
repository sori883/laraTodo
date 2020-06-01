<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Task;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
    return [
        'title' => $faker->text,
        'status' => false,
        'limit_at' => $faker->date,
        'user_id' => 1,
        'created_at' => $faker->date,
        'updated_at' => $faker->date
    ];
});
