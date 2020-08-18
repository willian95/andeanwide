<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'id'                => $this->id,
            'user_id'           => $this->user_id,
            'symbol'            => new SymbolResource($this->symbol),
            'priority_id'       => $this->priority_id,
            'priority_label'    => $this->priority_label,
            'priority_sublabel' => $this->priority_sublabel,
            'payment_amount'    => number_format($this->payment_amount),
            'total_cost'        => number_format($this->total_cost),
            'sended_amount'     => number_format($this->sended_amount),
            'exchange_rate'     => number_format($this->exchange_rate, 6),
            'received_amount'   => number_format($this->received_amount),
            'recipient'         => new RecipientResource($this->recipient),
            'payment'           => new PaymentResource($this->payment),
            'filled'            => isset($this->filled_at) ? true : false,
            'verified'          => isset($this->verified_at) ? true : false,
            'rejected'          => isset($this->rejected_at) ? true : false,
            'expired'           => isset($this->expired_at) ? true : false,
            'completed'         => isset($this->completed_at) ? true : false,
            'created_at'        => $this->created_at
        ];
    }
}
