<?php

namespace Tests\Unit;

use App\Models\Platform;
use Tests\TestCase;

class PlatformTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    
    public function setUp() :void {
        parent::setUp();
        $this->platform = PlatForm::factory()->make();
    }


    public function test_if_platform_has_device() {
         $this->assertNotEmpty($this->platform->device);
         $this->assertIsString($this->platform->device);
         $this->assertContains($this->platform->device, ["web","mobile"]);
    }
}
