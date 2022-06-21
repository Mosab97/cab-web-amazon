<?php

namespace App\Http\Requests\Api\Order;

use App\Http\Requests\Api\ApiMasterRequest;

class DriverChangeOrderStatus extends ApiMasterRequest
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
           'order_status' => 'required|in:driver_finish,pre_client_accept_start,driver_cancel',
        ];
    }
}
