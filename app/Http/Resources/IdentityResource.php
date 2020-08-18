<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class IdentityResource extends JsonResource
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
            'id'                    => $this->id,
            'country'               => $this->country,
            'nationality'           => $this->nationality,
            'first_name'            => $this->first_name,
            'middle_name'           => $this->middle_name,
            'last_name'             => $this->last_name,
            'second_surname'        => $this->second_surname,
            'dni_number'            => $this->dni_number,
            'validation_number'     => $this->validation_number,
            'expiration_date'       => $this->expiration_date,
            'issue_date'            => $this->issue_date,
            'dob'                   => $this->dob,
            'document_type'         => $this->document_type,
            'gender'                => $this->gender,
            'document_front_url'    => $this->front_image_url,
            'document_back_url'     => $this->back_image_url,
            'verified'              => $this->verified_at ? true : false
        ];
    }
}
