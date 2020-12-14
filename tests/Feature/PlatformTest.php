<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Schema;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Platform;
use Tests\TestCase;

class PlatformTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    protected $table_name = "platforms";
    protected $table_cols  = ["device"];


    public function setUp() : void{
        parent::setUp();
        $this->platform = Platform::factory()->make();
    }


    public function test_if_platforms_table_has_expected_cols() {
        $platformsTableHasCols = Schema::hasColumns($this->table_name, $this->table_cols);

        $this->assertTrue($platformsTableHasCols);
    }

    public function test_if_a_platform_is_saved() {
        $platFormIsSaved =  $this->platform->save();
        $this->assertTrue($platFormIsSaved);
    }
}
