<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
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
            'user_id'               => $this->user_id,
            'account'               => new AccountResource($this->account),
            'transaction_number'    => $this->transaction_number,
            'transaction_date'      => $this->transaction_date,
            'payment_amount'        => number_format($this->payment_amount),
            'image_url'             => $this->image_url,
            'created_at'            => $this->created_at,
        ];
    }
}
