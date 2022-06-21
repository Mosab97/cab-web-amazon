<?php

namespace App\Http\Requests\Api\Order;

use App\Http\Requests\Api\ApiMasterRequest;

class OrderRequest extends ApiMasterRequest
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
        

        if ($this->order_type == 'delivery') {
            $rules['budget'] = 'nullable';
        } else {

            $rules['budget'] = 'required|numeric|gte:' . (setting('min_offer_price') ?? 10);
        }


        $rules += ['start_location' => 'required'];
        $rules += ['start_location.lat' => 'required|numeric'];
        $rules += ['start_location.lng' => 'required|numeric'];
        $rules += ['start_location.location' => 'required|string|between:2,250'];

        $rules += ['end_location.lat' => 'required|numeric'];
        $rules += ['end_location.lng' => 'required|numeric'];
        $rules += ['end_location.location' => 'required|string|between:2,250'];

        $rules += ['order_type' => 'required|in:delivery,ride']; //package,trip,order

        $rules += ['car_type_id' => 'required_if:order_type,delivery|exists:car_types,id,deleted_at,NULL'];
        //    'budget' =>> 'required_if:order_type,ride|numeric|gte:'.(setting('min_offer_price') ?? 10),
        $rules += ['expected_order_price' => 'nullable|numeric|gt:0']; //|required_if:order_type,delivery
        $rules += ['order_details' => 'nullable|required_if:order_type,delivery|string|between:3,1000'];

        $rules += ['pay_type' => 'nullable|in:cash,wallet'];

        $rules += ['distance' => 'required|numeric|gte:0'];
        $rules += ['expected_time' => 'required|numeric|gte:0'];
        $rules += ['expected_route' => 'nullable|string|between:2,900000'];

        // return [
        //     'start_location' => 'required',
        //     'start_location.lat' => 'required|numeric',
        //     'start_location.lng' => 'required|numeric',
        //     'start_location.location' => 'required|string|between:2,250',

        //     'end_location.lat' => 'required|numeric',
        //     'end_location.lng' => 'required|numeric',
        //     'end_location.location' => 'required|string|between:2,250',

        //     'order_type' => 'required|in:delivery,ride', //package,trip,order

        //     'car_type_id' => 'required_if:order_type,delivery|exists:car_types,id,deleted_at,NULL',
        //     //    'budget' => 'required_if:order_type,ride|numeric|gte:'.(setting('min_offer_price') ?? 10),
        //     'expected_order_price' => 'nullable|numeric|gt:0', //|required_if:order_type,delivery
        //     'order_details' => 'nullable|required_if:order_type,delivery|string|between:3,1000',

        //     'pay_type' => 'nullable|in:cash,wallet',

        //     'distance' => 'required|numeric|gte:0',
        //     'expected_time' => 'required|numeric|gte:0',
        //     'expected_route' => 'nullable|string|between:2,900000',
        // ];

        return $rules;
    }
}
