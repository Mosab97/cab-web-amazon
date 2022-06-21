<?php

namespace App\Http\Requests\Api\User;

use App\Http\Requests\Api\ApiMasterRequest;

class LuckyBoxRequest extends ApiMasterRequest
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
        $user = auth('api')->user();
        switch ($user->user_type) {
            case 'driver':
                $order = 'required|exists:orders,id,driver_id,'.$user->id;
                break;
            default:
                $order = 'required|exists:orders,id,client_id,'.$user->id;
                break;
        }
        return [
           'order_id' => $order,
           'lucky_box_id' => 'required|exists:lucky_boxes,id',
        ];
    }

}
