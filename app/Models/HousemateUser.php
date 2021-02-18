<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HousemateUser extends Model
{
    use HasFactory;
    
    protected $table = 'housemate_user';

    public $incrementing = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'housemate_id',
        'platform_id',
        'amount',
    ];

    /**
     * The relationship between HousemateUser and Platform
     * 
     * @return null
     * 
     * @return App\Models\Platform|array
     */

    public function platforms() {
        return $this->belongsToMany('App\Models\Platform');
    }
}
