<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'tags' => 'alternative hiphop, jazz rap',
            'company' => $this->faker->company(),
            'label' => $this->faker->name(),
            'website' => $this->faker->url(),
            'location' => $this->faker->year(),
            'description' => $this->faker->paragraph(5),

        ];
    }
}
