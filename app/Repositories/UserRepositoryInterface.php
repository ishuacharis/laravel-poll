<?php

namespace App\Repositories;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder as Builder;

interface UserRepositoryInterface
{
    public function where(string $attribute, string $value): Builder;

    public function findOrFail(int $attribute): ?Model;
}