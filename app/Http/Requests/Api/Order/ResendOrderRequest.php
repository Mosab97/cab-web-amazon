<?php

namespace App\Http\Requests\Api\Order;

use App\Http\Requests\Api\ApiMasterRequest;

class ResendOrderRequest extends ApiMasterRequest
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
        $rules = [];

            if($this->order_type == 'delivery'){
                $rules['budget'] = 'nullable';
            } else {

                $rules['budget'] = 'required|numeric|gte:' . (setting('min_offer_price') ?? 10);
            }


            $rules['order_id'] = 'required|exists:orders,id,deleted_at,NULL,accepted_offer_id,NULL';


        return $rules;
    }
}
