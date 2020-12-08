<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\Housemate;
use App\Models\Platform;
use App\Models\HousemateUser;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(2)->create();
        Housemate::factory(5)->create();
        Platform::factory(2)->create();
        HousemateUser::factory(10)->create();
    }
}
