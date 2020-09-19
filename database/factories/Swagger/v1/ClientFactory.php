<?php

namespace Database\Factories\Swagger\v1;

use App\Models\Swagger\v1\Client;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Client::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type' => $this->faker->boolean,
            'name' => $this->faker->text,
            'image' => $this->faker->imageUrl(),
            'settings' => json_encode($this->faker->linuxProcessor),
        ];
    }
}
