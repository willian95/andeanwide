<?php 

namespace App\Traits;

trait Parameters
{
    public function getPriorities()
    {
        return collect(Array(
            (object) [
                'name'      => 'normal',
                'title'     => 'Normal',
                'subtitle'  => '3 días hábiles',
                'pct'       => env('NORMAL_PRIORITY_PCT'),
            ],
            (object) [
                'name'      => 'high',
                'title'     => 'Alta', 
                'subtitle'  => 'Mismo día',
                'pct'       => env('HIGH_PRIORITY_PCT'),
            ]
        ));
    }

    public function getTransactionPct()
    {
        return env('TRANSACTION_COST_PCT');
    }

    public function getIVA()
    {
        return env('IVA_PCT');
    }
}