<?php

namespace App\Interfaces;

interface IPassword{


    public function check(array $args);

    public function make(array $args);

}