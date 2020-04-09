<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Admin;
use App\Customer;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

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

$factory->define(Admin::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => 'admin@admin.com',
        'email_verified_at' => now(),
        'password' => '$2y$10$LEQ4VQSvI8ZLN1pVn99p3ucpSye0fRmPo3vMe4g6MO10iIVeGLcZS', // password
        'remember_token' => Str::random(10),
    ];
});
$factory->define(\App\Follower::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => 'follower@follower.com',
        'email_verified_at' => now(),
        'password' => '$2y$10$LEQ4VQSvI8ZLN1pVn99p3ucpSye0fRmPo3vMe4g6MO10iIVeGLcZS', // password
        'remember_token' => Str::random(10),
    ];
});
$factory->define(\App\Streamer::class, function (Faker $faker) {
    return [
        'name_ar' => $faker->name,
        'name_en' => $faker->name,
        'email' => 'streamer@streamer.com',
        'email_verified_at' => now(),
        'password' => '$2y$10$LEQ4VQSvI8ZLN1pVn99p3ucpSye0fRmPo3vMe4g6MO10iIVeGLcZS', // password
        'remember_token' => Str::random(10),
    ];
});
