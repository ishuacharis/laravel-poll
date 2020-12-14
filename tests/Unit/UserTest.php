<?php

namespace Tests\Unit;

//use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshMigrations;
use App\Models\User;

class UserTest extends TestCase
{
    //Use DatabaseMigrations;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }


    private $user;

    public function setUp() : void {
        parent::setUp();
        $this->user = User::factory()->make();
    }


    public function test_user_has_name(){
        $this->assertNotEmpty($this->user->name);
        $this->assertIsString($this->user->name);
    }

    public function test_user_has_email(){
        $this->assertNotEmpty($this->user->email);
        $this->assertStringContainsString("@",$this->user->email);
    }

    public function test_user_has_phoneNo(){
        $this->assertNotEmpty($this->user->phone_no);
        $this->assertStringContainsString("+",$this->user->phone_no);
    }

    public function test_user_has_password(){
        $this->assertNotEmpty($this->user->password);
        $this->assertIsString($this->user->password);
    }

    
}
