<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Models\Film::class, function (Faker $faker) {
    $createdAt = $faker->dateTimeBetween('-3 months','-2 months');
    $title = $faker->sentence(5);
    return [
        'title' =>$title,
        'meta_title'=>$faker->sentence(5),
        'slug'=>Str::slug($title),
        'status'=>"Опубликовано",
        'created_at' => $createdAt,
        'updated_at' => $createdAt,
    ];
});
