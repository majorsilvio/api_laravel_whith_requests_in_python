<?php
use Faker\Generator as Faker;
use App\Game;

$factory->define(\App\Game::class, function (Faker $faker) {
    return [
	    'name' => $faker->random('God of war', 'Doubles and drogons', 'Dungeons and dragons'),
	    'genero' => $faker->random('Aventura', 'RPG', 'ação'),
	    'idade_indicativa' => $faker->random(0, 10, 18),
	    'price' => $faker->random(2.0, 10.0, 8.0),
    ];
});