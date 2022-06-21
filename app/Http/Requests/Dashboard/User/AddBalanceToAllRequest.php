<?php

namespace App\Http\Requests\Dashboard\User;

use Illuminate\Foundation\Http\FormRequest;

class AddBalanceToAllRequest extends FormRequest
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
            'amount' => 'required|numeric',
            'user_type' => 'required|in:client,driver',
            'user_list' => 'nullable|array',
            'user_list.*' => 'nullable|exists:users,id',
        ];
    }
}
