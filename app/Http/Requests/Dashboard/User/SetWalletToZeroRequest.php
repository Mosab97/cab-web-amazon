<?php

namespace App\Http\Requests\Dashboard\User;

use Illuminate\Foundation\Http\FormRequest;

class SetWalletToZeroRequest extends FormRequest
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
            'user_type' => 'required|in:client,driver',
            'user_list' => 'nullable|array',
            'user_list.*' => 'nullable|exists:users,id',
            'order_status' => 'nullable|in:all_clients,clients_not_have_orders,clients_not_have_finished_orders,clients_not_use_lucky_boxes,clients_not_charge_thier_wallet',
        ];
    }
}
