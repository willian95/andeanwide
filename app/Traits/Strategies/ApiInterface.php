<?php

namespace App\Traits\Strategies;

use App\Symbol;

interface ApiInterface
{
    public function performRequest(Symbol $symbol);
}