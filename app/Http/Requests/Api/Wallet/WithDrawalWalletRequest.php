<?php

namespace App\Http\Requests\Api\Wallet;

use App\Http\Requests\Api\ApiMasterRequest;

class WithDrawalWalletRequest extends ApiMasterRequest
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
           'amount'    => 'required|integer|gte:'.((float)setting('min_limit_withdrawal') ?? 100),
           'iban_number'    => 'required|string|between:2,250',
        ];
    }
}
