<?php

namespace App\Http\Requests\Dashboard\User;

use Illuminate\Foundation\Http\FormRequest;

class ConvertUnavailableDriversToAvailableRequest extends FormRequest
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
            'status' => 'nullable|in:deactive,ban,accepted,paid,wait_accept_drivers,refused_drivers,available,not_available,drivers_subscribed_this_week,with_special_needs,both_type,delivery,ride,monthly_drivers,on_order_drivers,has_balance_in_wallet,disable_to_recieve_orders,driver_without_orders',
            'driver_list' => 'nullable|array',
            'driver_list.*' => 'nullable|exists:users,id',
        ];
    }
}
