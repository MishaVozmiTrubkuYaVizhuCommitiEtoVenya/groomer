<?php

namespace Database\Factories\Swagger\v1;

use App\Models\Swagger\v1\Order;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'working_diapason_start_id' => $this->faker->randomDigitNotNull,
            'pet_id' => $this->faker->randomDigitNotNull,
            'phone' => $this->faker->phoneNumber,
            'pet_name' => $this->faker->name,
            'owner_name' => $this->faker->name,
        ];
    }
}
