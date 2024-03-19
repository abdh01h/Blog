<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $factory->define(Article::class, function (Faker $faker) {
            return [
                'user_id' => 1,
                'title' => $faker->text,
                'content' => $faker->paragraph,
            ];
        });
        
    }

}
