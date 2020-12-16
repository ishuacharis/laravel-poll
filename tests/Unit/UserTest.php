<?php

namespace Tests\Unit;

//use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshMigrations;
use Illuminate\Database\Eloquent\Collection;
use App\Models\User;
use App\Models\Housemate;

class UserTest extends TestCase
{
    Use DatabaseMigrations;
    /**
     * A basic unit test example.
     *
     * @return void
     */

    private $user;

    public function setUp() : void {
        parent::setUp();
        $this->user = User::factory()->make();
    }

    public function test_if_user_is_an_user_instanse() {
        $this->assertInstanceOf(User::class,$this->user);
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

    public function test_a_user_belongs_to_many_housemates() {

        $user = User::factory()->create();
        $housemate = Housemate::factory()->create();

        $this->assertInstanceOf(User::class, $user);
        $this->assertInstanceOf(Housemate::class, $housemate);
        $this->assertInstanceOf(Collection::class, $user->housemates);
    }

    public function test_user_does_not_have_username(){
        unset($this->user->username);
        $this->assertEmpty($this->user->username);
    }

    public function test_user_does_not_have_email(){
        unset($this->user->email);
        $this->assertEmpty($this->user->email);
    }

    public function test_user_does_not_have_phoneNo(){
        unset($this->user->phone_no);
        $this->assertEmpty($this->user->phone_no);
    }

    public function test_user_does_not_have_password(){
        unset($this->user->password);
        $this->assertEmpty($this->user->password);
    }


    
}
