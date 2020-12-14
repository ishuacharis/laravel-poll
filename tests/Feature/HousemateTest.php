<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Schema;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Housemate;
use Tests\TestCase;


class HousemateTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    protected $table_name = "housemates";
    protected $table_cols  = ["name", "screen_name"];

    public function setUp() : void{
        parent::setUp();
        $this->housemate = Housemate::factory()->make();
    }

    public function test_if_housemates_table_has_expected_cols() {
        $housematesTableHasCols = Schema::hasColumns($this->table_name, $this->table_cols);
        $this->assertTrue($housematesTableHasCols);
    }

    public function test_if_housemate_can_be_saved_to_database() {
        $isHousemateSaved =  $this->housemate->save();
        $this->assertTrue($isHousemateSaved);
    }

    
}
