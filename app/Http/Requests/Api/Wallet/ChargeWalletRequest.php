<?php

namespace App\Http\Requests\Api\Wallet;

use App\Http\Requests\Api\ApiMasterRequest;

class ChargeWalletRequest extends ApiMasterRequest
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
        $amount = auth('api')->user()->user_type == 'driver' ? 'required|integer|gte:1' : 'required|integer|gte:1';
        return [
           'amount' => $amount,
           'transaction_id' => 'required|string|between:2,250',
        ];
    }
}
