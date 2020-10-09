<?php

namespace Database\Factories\Swagger\v1;

use App\Models\Swagger\v1\WorkingDiapason;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class WorkingDiapasonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WorkingDiapason::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'size' => $this->faker->randomDigitNotNull,
            'master_id' => $this->faker->numberBetween(1,50),
            'time_start' => $this->faker->dateTime,
            'state' => $this->faker->boolean(),
        ];
    }
}
