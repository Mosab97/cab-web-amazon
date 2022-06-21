<?php

namespace App\Http\Requests\Dashboard\WalletTransaction;

use Illuminate\Foundation\Http\FormRequest;

class WalletTransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'transfer_status' => 'required|in:refused,transfered,pending',
            // 'wallet_id' => 'required|exists:wallet_transactions,id',
        ];
    }


}
