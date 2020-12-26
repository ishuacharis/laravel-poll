<?php

namespace App\Repositories;
use Illuminate\Eloquent\Database\Model;

interface EloquentRepositoryInterface
{
    public function create(array $attributes) : Model;

    public function find($attribute) : ?Model;
}