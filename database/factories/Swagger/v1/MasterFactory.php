<?php

namespace Database\Factories\Swagger\v1;

use App\Models\Swagger\v1\Master;
use Illuminate\Database\Eloquent\Factories\Factory;

class MasterFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Master::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'image' => $this->faker->imageUrl(),
        ];
    }
}
