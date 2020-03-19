<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Reply;
use Faker\Generator as Faker;

$factory->define(Reply::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return create('App\User')->id;
        },
        'thread_id' => function () {
            return create('App\Thread')->id;
        },
        'body' => $faker->sentence,
    ];
});
