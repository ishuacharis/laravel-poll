<?php
namespace App\Repositories\Eloquent;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\VoteRepositoryInterface;
use App\Models\HousemateUser;
use Illuminate\Database\Eloquent\Model;

class VoteRepository extends BaseRepository implements VoteRepositoryInterface
{
    
    protected $model;

    public function __construct(HousemateUser $model)
    {
        $this->model = $model;
    }

    public function create(array $attributes) : Model
    {
        return $this->model->create($attributes);
    }
}
