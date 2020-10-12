<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SymbolResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'min_amount'    => $this->min_amount,
            'default_amount'=> $this->default_amount,
            'is_default'    => $this->is_default,
            'show_inverse'  => $this->show_inverse,
            'max_tier_1'    => $this->max_tier_1,
            'max_tier_2'    => $this->max_tier_2,
            'decimals'      => $this->decimals,
            'base'          => new CurrencyResource($this->base),
            'quoted'        => new CurrencyResource($this->quote)
        ];
    }
}
