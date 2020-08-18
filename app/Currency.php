<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $with = ['country'];

    public function country()
    {
        return $this->belongsTo('App\Country');
    }
}
