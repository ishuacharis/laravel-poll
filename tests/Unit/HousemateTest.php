<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Database\Eloquent\Collection;
use App\Models\User;
use App\Models\Housemate;

class HousemateTest extends TestCase
{
    Use DatabaseMigrations;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    private $housemate;

    public function setUp() : void {
        parent::setUp();
        $this->housemate = Housemate::factory()->make();
    }

    public function test_housemate_has_name() {
        $this->assertNotEmpty($this->housemate->name);
        $this->assertIsString($this->housemate->name);
    }

    public function test_housemate_has_screen_name() {
        $this->assertNotEmpty($this->housemate->screen_name);
        $this->assertIsString($this->housemate->screen_name);
    }

    public function test_a_housemate_has_many_users() {
        $user = User::factory()->create();
        $housemate = Housemate::factory()->create();

        
        $this->assertInstanceOf(User::class, $user);
        $this->assertInstanceOf(Housemate::class, $housemate);
        $this->assertInstanceOf(Collection::class, $housemate->users);
    }

    
}
