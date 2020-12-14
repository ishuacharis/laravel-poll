<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Housemate;

class HousemateTest extends TestCase
{
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

    
}
