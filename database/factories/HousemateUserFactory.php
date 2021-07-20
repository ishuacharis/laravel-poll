<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Housemate;
use App\Models\Platform;
use App\Models\HousemateUser;
use Illuminate\Database\Eloquent\Factories\Factory;

class HousemateUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = HousemateUser::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'user_id' => User::inRandomOrder()->first(),
            'housemate_id' => Housemate::inRandomOrder()->first(),
            'platform_id' => Platform::inRandomOrder()->first(),
            'amount' => $this->faker->numberBetween(1,1000)
        ];
    }
}
