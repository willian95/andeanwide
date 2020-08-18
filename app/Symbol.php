<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Symbol extends Model
{
    protected $with = ['base', 'quote'];

    public function base()
    {
        return $this->belongsTo('App\Currency', 'base_cur_id');
    }

    public function quote()
    {
        return $this->belongsTo('App\Currency', 'quote_cur_id');
    }
}
