<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Housemate;
use App\Models\Platform;
use App\Models\Vote;
use Illuminate\Database\Eloquent\Factories\Factory;

class VoteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vote::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'user_id' => User::factory(),
            'housemate_id' => Housemate::factory(),
            'platform_id' => 1,
            'amount' => $this->faker->numberBetween()
        ];
    }
}
