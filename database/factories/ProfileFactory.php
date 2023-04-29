<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
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
            'name' => $this->faker->name(),
            'bio' => $this->faker->text(100),
            'avatar'=> "https://randomuser.me/api/portraits/lego/$randomNumber.jpg"
        ];
    }
}
