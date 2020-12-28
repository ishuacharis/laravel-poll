<?php

namespace App\Repositories;

interface UserRepositoryInterface
{
    public function where(string $attribute, string $value);

    public function create(array $attributes);
}