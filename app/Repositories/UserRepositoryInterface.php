<?php

namespace App\Repositories;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder as Builder;
use Illuminate\Support\Collection;
use App\Http\Resources\NotificationCollection;

interface UserRepositoryInterface
{
    public function where(string $attribute, string $value): Builder;

    public function findOrFail(int $attribute): ?Model;

    public function allNotification(Collection $collection) : NotificationCollection;
}