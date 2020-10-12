<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $with = ['currencySended', 'currencyReceived', 'payment', 'symbol'];

    public function recipient()
    {
        return $this->belongsTo('App\Recipient');
    }

    public function currencySended()
    {
        return $this->belongsTo('App\Currency', 'currency_sended_id');
    }

    public function currencyReceived()
    {
        return $this->belongsTo('App\Currency', 'currency_received_id');
    }

    public function payment()
    {
        return $this->hasOne('App\Payment');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function symbol()
    {
        return $this->belongsTo('App\Symbol');
    }

    public function getStatusAttribute()
    {
        if(isset($this->rejected_at)) {
            return 'rejected';
        } else if(isset($this->expired_at)) {
            return 'expired';
        } else if(isset($this->completed_at)) {
            return 'completed';
        } else if(is_null($this->filled_at)) {
            return 'incompleted';
        } else if(isset($this->filled_at) && is_null($this->payment) && is_null($this->rejected_at) && is_null($this->expired_at)) {
            return 'pending_payment';
        } else if(isset($this->filled_at) && isset($this->payment) && is_null($this->rejected_at) && is_null($this->expired_at) && is_null($this->verified_at) && is_null($this->completed_at)) {
            return 'upload_payment';
        } else if(isset($this->filled_at) && isset($this->payment) && is_null($this->rejected_at) && is_null($this->expired_at) && isset($this->verified_at) && is_null($this->completed_at)) {
            return 'verified';
        }
    }
}
