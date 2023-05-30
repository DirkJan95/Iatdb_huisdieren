<?php

namespace Database\Factories;

use App\Models\Pet;
use Illuminate\Database\Eloquent\Factories\Factory;

class PetFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pet::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'breed' => $this->faker->word,
            'date' => $this->faker->date,
            'how_long' => $this->faker->word,
            'cost' => $this->faker->numberBetween(100, 1000),
            'age' => $this->faker->numberBetween(1, 20),
            'pet_picture' => null, // or $this->faker->imageUrl() to generate a random image URL
            'created_at' => $this->faker->dateTime,
            'updated_at' => $this->faker->dateTime,
        ];
    }
}
