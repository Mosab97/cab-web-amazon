<?php

namespace App\Http\Resources\Dashboard\WalletTransaction;

use Illuminate\Http\Resources\Json\JsonResource;

class SingleWalletTransactionResource extends JsonResource
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
            'user' => view('dashboard.report.ajax.user_link',['user' => $this->user])->render(),
            'addedBy' => ['id' => $this->added_by_id, 'fullname' => @$this->addedBy->fullname],
            'transaction_id' => $this->transaction_id,
            'amount' => $this->amount,
            'created_at' => $this->created_at->format("Y-m-d"),
            'added_time' => $this->created_at->format("h:i A"),
        ];
    }
}
