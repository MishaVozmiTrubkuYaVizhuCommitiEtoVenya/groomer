<?php

namespace Database\Factories\Swagger\v1;

use App\Models\Swagger\v1\Pet;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
            'average_time_work' => $this->faker->randomDigitNotNull,
        ];
    }
}
