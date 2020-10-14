<?php

namespace Database\Factories\Swagger\v1;

use App\Models\Swagger\v1\Service;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ServiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Service::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->jobTitle,
            'client_id' => $this->faker->numberBetween(1,50),
            'image' => $this->faker->imageUrl(),
            'text' => $this->faker->realText(),
            'price' => $this->faker->randomFloat(2, 10, 3000),
            'type' => $this->faker->randomElement([0,1,2]),
        ];
    }
}
