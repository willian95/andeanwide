<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $with = ['country', 'currency'];

    public function country()
    {
        return $this->belongsTo('App\Country');
    } 

    public function currency()
    {
        return $this->belongsTo('App\Currency');
    }
}
