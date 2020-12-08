<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HousemateUser extends Model
{
    use HasFactory;
    
    protected $table = 'housemate_user';

    public $incrementing = true;


    public function platforms() {
        return $this->belongsToMany('App\Models\Platform');
    }
}
