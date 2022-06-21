<?php

namespace App\Http\Requests\Api\Wallet;

use App\Http\Requests\Api\ApiMasterRequest;

class TransferWalletRequest extends ApiMasterRequest
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
        $wallet = auth('api')->user()->wallet;
        return [
           'amount'    => 'required|integer|gte:'.(float)setting('min_amount_in_transfer_transaction') . "|lte:". $wallet,
           'phone'    => 'required|numeric|digits_between:5,20|exists:users,phone,deleted_at,NULL,user_type,client',
        ];
    }

    public function getValidatorInstance()
    {
       $data = $this->all();
       if (isset($data['phone']) && $data['phone']) {
           $data['phone'] = filter_mobile_number($data['phone']);
       }

       $this->getInputSource()->replace($data);
       return parent::getValidatorInstance();
    }
}
