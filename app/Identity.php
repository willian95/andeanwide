<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Identity extends Model
{
    protected $with = ['country'];
    
    public function country()
    {
        return $this->belongsTo('App\Country');
    }
}
