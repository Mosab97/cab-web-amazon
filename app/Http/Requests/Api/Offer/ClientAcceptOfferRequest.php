<?php

namespace App\Http\Requests\Api\Offer;

use App\Http\Requests\Api\ApiMasterRequest;

class ClientAcceptOfferRequest extends ApiMasterRequest
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
           'order_id' => 'required|exists:orders,id,deleted_at,NULL',
           'offer_id' => 'required|exists:order_offers,id',
        ];
    }
}
