<?php

namespace App\Http\Resources;

use App\Http\Resources\CountryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class RecipientResource extends JsonResource
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
            'lastname'      => $this->lastname,
            'dni'           => $this->dni,
            'phone'         => $this->phone,
            'email'         => $this->email,
            'bank_name'     => $this->bank_name,
            'bank_account'  => $this->bank_account,
            'address'       => $this->address,
            'bank_code'     => $this->code,
            'country'       => new CountryResource($this->country)
        ];
    }
}
