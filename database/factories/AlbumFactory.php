<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AlbumFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'             => $this->faker->sentence(),
            'tags'              => 'west coast hiphop, Chamber pop, Black metal',
            'artist'            => $this->faker->name(),
            'label'             => $this->faker->name(),
            'website'           => $this->faker->url(),
            'year'              => $this->faker->year(),
            'description'       => $this->faker->paragraph(6),
            'tracklist'         => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
        ];
    }
}
