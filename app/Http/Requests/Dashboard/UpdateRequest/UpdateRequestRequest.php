<?php

namespace App\Http\Requests\Dashboard\UpdateRequest;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequestRequest extends FormRequest
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
            'update_status' => 'required|in:refused,accepted',
            'refuse_reason' => 'nullable|required_if:update_status,refused|string|between:2,1000',            
        ];
    }
}
