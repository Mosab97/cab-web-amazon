<?php

namespace App\Http\Requests\Api\Order;

use App\Http\Requests\Api\ApiMasterRequest;
use App\Models\Order;

class OrderOfferRequest extends ApiMasterRequest
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
        // return [

        //     'offer_price' => 'required|numeric',

        //     'order_id' => 'required|exists:orders,id,deleted_at,NULL,accepted_offer_id,NULL',

        //     'cost_reason' => 'nullable|string|between:2,100000',
        //  ];
        $rules = [];

        if (optional(Order::whereNull('accepted_offer_id')->findOrFail($this->order_id))->order_type == 'delivery') {
            $rules['offer_price'] = 'required|numeric';
        } else {

            $rules['offer_price'] = 'required|numeric|gte:' . (setting('min_offer_price') ?? 10);
        }

        $rules['order_id'] = 'required|exists:orders,id,deleted_at,NULL,accepted_offer_id,NULL';

        $rules['cost_reason'] = 'nullable|string|between:2,100000';

        return $rules;
    }
}
