<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Status::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'parent_id' => null,
        'body' => $faker->paragraph
    ];
});
