<?php

namespace Database\Factories;

use App\Models\Housemate;
use Illuminate\Database\Eloquent\Factories\Factory;

class HousemateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Housemate::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'name' => $this->faker->name,
            'screen_name' => $this->faker->firstName
        ];
    }
}
