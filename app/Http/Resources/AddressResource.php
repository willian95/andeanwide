<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
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
            'address'       => $this->address,
            'address_ext'   => $this->address_ext,
            'country_id'    => $this->country_id,
            'state'         => $this->state,
            'city'          => $this->city,
            'cod'           => $this->cod,
            'verified'      => $this->verified_at ? true : false,
            'image_url'     => $this->image_url,
        ];
    }
}
