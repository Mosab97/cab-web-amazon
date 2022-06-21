<?php

namespace App\Http\Resources\Dashboard\WalletTransaction;

use Illuminate\Http\Resources\Json\ResourceCollection;

class WalletTransactionResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $transaction_count = isset($this->additional['transaction_count']) ? $this->additional['transaction_count'] : 0;
        return [
            'data'              => SingleWalletTransactionResource::collection($this->collection),
            "draw"              =>  intval($request->draw),
            "recordsTotal"      =>  intval($transaction_count),
            "recordsFiltered"   =>  intval($transaction_count),
        ];
    }
}
