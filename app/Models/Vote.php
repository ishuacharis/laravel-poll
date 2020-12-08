<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Pivot
{
    use HasFactory;

    public $incrementing = true;


    public function platforms() {
        return $this->belongsTo('App\Models\Platform');
    }
}
