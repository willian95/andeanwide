<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AccountResource extends JsonResource
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
            'bank_name'     => $this->bank_name,
            'bank_account'  => $this->bank_account,
            'bank_code'     => $this->code,
            'account_name'  => $this->account_name,
            'country'       => new CountryResource($this->country),
            'currency'      => new CurrencyResource($this->currency)
        ];
    }
}
