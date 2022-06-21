<?php

namespace App\Http\Requests\Dashboard\RenewRequest;

use Illuminate\Foundation\Http\FormRequest;

class RenewRequestRequest extends FormRequest
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
            'renew_status' => 'required|in:refused,accepted',
            'refuse_reason' => 'nullable|string|between:2,1000',            
        ];
    }
}
