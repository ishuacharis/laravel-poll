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

    public function check(array $args)
    {
        return $this->hash::check($args['password'], $args['hash_password']);
    }

    public function make(array $args)
    {
        return $this->hash::make($args['password']);
    }
}