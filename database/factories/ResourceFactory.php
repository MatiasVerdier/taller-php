<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Resource::class, function (Faker\Generator $faker) {
  
  $visibility = ['PUBLIC', 'SHARED', 'PRIVATE'];

  return [
    'type' => '',
    'title' => $faker->sentence(4, true),
    'description' => $faker->optional()->text,
    'link' => '',
    'link_type' => '',
    'link_image' => '',
    'link_author' => '',
    'markdown' => '',
    'code' => '',
    'code_type' => '',
    'visibility' => $faker->randomElement($visibility),
    'likes' => $faker->numberBetween(0,100)
  ];
});

$factory->state(App\Resource::class, 'LINK', function (Faker\Generator $faker) {
    return [
      'type' => 'LINK',
      'link' => $faker->url,
      'link_date' => $faker->optional()->dateTime,
      'link_image' => $faker->optional()->imageUrl(640, 480),
      'link_author' => $faker->optional()->name
    ];
});

$factory->state(App\Resource::class, 'MARKDOWN', function (Faker\Generator $faker) {
    return [
      'type' => 'MARKDOWN',
      'markdown' => $faker->realText
    ];
});

$factory->state(App\Resource::class, 'CODE', function (Faker\Generator $faker) {
    return [
      'type' => 'CODE',
      'code_type' => $faker->optional()->word,
      'code' => $faker->realText
    ];
});
