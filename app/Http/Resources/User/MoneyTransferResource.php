<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Help\SimpleUserResource;

class MoneyTransferResource extends JsonResource
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
            'id' => $this->id,
            'amount' => (int) $this->amount,
            'created_at' => $this->created_at->format("M d, Y H:i"),
            'wallet_before_transfer' => (int) $this->wallet_before,
            'wallet_after_transfer' => (int) $this->wallet_after,
            'transfer_to' => new SimpleUserResource($this->transferTo),
        ];
    }
}
