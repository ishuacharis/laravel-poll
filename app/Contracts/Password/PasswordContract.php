<?php

namespace App\Contracts\Password;

use Illuminate\Support\Facades\Hash;
use App\Interfaces\IPassword;

class PasswordContract implements IPassword
{

    protected $hash;

    public function __construct(Hash $hash) {
        $this->hash = $hash;
    }

    public function check(String $password, String $hash_password)
    {
        return $this->hash::check($password, $hash_password);
    }
}