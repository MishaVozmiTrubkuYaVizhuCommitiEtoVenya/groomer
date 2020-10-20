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

        $date = new \DateTime('now');
        $date->setTime(0,0,0);
        $date_start = $date->format('Y-m-d H:i:s');
        $date_end = $date->modify('+1 day')->format('Y-m-d H:i:s');


        try {
            $date_start = $date->modify('-'.random_int(0,13).' day')->format('Y-m-d H:i:s');
            $date_end = $date->modify('+'.random_int(13,35).' day')->format('Y-m-d H:i:s');
        } catch (\Exception $e) {
            logger('What are fuck? I can\'t create unique integer!');
        }

        return [
            'title' => $this->faker->title,
            'client_id' => $this->faker->numberBetween(1,50),
            'full_description' => $this->faker->realText(),
            'image_url' => "https://picsum.photos/512/512",
            'date_start' => $date_start,
            'date_end' => $date_end
        ];
    }
}
