<?php
namespace App\Repositories;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use App\Http\Resources\HousemateCollection;

interface HousemateRepositoryInterface
{

    public function collection(Collection $collection) : HousemateCollection;
    public function all() : Collection;
    
}