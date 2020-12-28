<?php

namespace App\Repositories;
use Illuminate\Eloquent\Database\Model;
use App\Models\User;

interface EloquentRepositoryInterface
{
    public function create(array $attributes) : Model;

    public function find($attribute) : ?Model;

    public function where (string $attribute, string $value) : Model;
}