<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Stars>
 */
class StarsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $randomNumber = rand(0,9);
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'bio' => $this->faker->text(1000),
            'avatar'=> "https://randomuser.me/api/portraits/lego/$randomNumber.jpg"
        ];
    }
}
