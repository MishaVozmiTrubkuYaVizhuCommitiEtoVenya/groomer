<?php

namespace Database\Factories\Swagger\v1;

use App\Models\Swagger\v1\Promotion;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PromotionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Promotion::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->title,
            'client_id' => $this->faker->numberBetween(1,50),
            'text' => $this->faker->realText(),
            'image' => $this->faker->imageUrl(),
            'date_start' => $this->faker->dateTime()
        ];
    }
}
