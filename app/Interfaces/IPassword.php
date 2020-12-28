<?php

namespace App\Interfaces;

interface IPassword{


    public function check(String $password, String $hash_password);

    public function make(String $password);

}