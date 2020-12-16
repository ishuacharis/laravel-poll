<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Schema;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;


class UserTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    private $user;
    protected $table_name = "users";
    protected $table_cols = ["name", "email", "phone_no", "password"];


    public function setUp() : void {
        parent::setUp();
        $this->user = User::factory()->make();
    }

    public function test_users_table_has_expected_cols() {
        $usersTableHasCols =  Schema::hasColumns($this->table_name, $this->table_cols);
        $this->assertTrue($usersTableHasCols);
    }

    public function test_save_user_to_database() {
        $isUserSavedToDatabase  = $this->user->save();
        $this->assertTrue($isUserSavedToDatabase);
    }

    
}
