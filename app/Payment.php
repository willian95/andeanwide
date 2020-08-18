<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $with = ['account'];

    public function account()
    {
        return $this->belongsTo('App\Account');
    }
}
