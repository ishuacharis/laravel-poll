<?php

namespace App\Repositories\Eloquent;

use App\Models\Housemate;
use Illuminate\Support\Collection;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\HousemateRepositoryInterface;
use App\Http\Resources\HousemateCollection;

class HousemateRepository extends BaseRepository implements HousemateRepositoryInterface
{
    
    protected $model;

    public function __construct(Housemate $model)
    {
        $this->model = $model;
        parent::__construct($model);
    }

    public function collection(Collection $collection) : HousemateCollection
    {
        return new HousemateCollection($collection);
    }

    public function all() : Collection
    {
        return $this->model->all();
    }
}
