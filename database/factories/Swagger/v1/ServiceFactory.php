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
            'image' => $this->faker->imageUrl(),
            'text' => $this->faker->realText(),
        ];
    }
}
