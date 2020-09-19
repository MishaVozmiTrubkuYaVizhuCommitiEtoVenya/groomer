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
            'text' => $this->faker->realText(),
            'url' => $this->faker->url,
        ];
    }
}
