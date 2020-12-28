<?php 

namespace App\Repositories\Eloquent;

use App\Repositories\UserRepositoryInterface;
use App\Repositories\Eloquent\BaseRepository;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Log;
class UserRepository implements UserRepositoryInterface
{

    protected $model;

    public function __construct(User $model)
    {
      $this->model = $model;
        //parent::__construct($model);
    }

    public function where(string $attribute, string $value)
    {   
        return $this->model->where($attribute, $value);
    }

}