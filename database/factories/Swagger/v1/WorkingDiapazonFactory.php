<?php

namespace Database\Factories\Swagger\v1;

use App\Models\Swagger\v1\WorkingDiapazon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class WorkingDiapazonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WorkingDiapazon::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'size' => $this->faker->randomDigitNotNull,
            'time_start' => $this->faker->dateTime,
            'state' => $this->faker->boolean(),
        ];
    }
}
