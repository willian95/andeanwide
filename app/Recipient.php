<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipient extends Model
{
    protected $with = ['country'];
    
    public function country()
    {
        return $this->belongsTo('App\Country');
    }
}
