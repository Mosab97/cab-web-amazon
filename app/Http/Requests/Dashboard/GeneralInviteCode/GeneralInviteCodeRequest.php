<?php

namespace App\Http\Requests\Dashboard\GeneralInviteCode;

use Illuminate\Foundation\Http\FormRequest;

class GeneralInviteCodeRequest extends FormRequest
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
        $code = $this->invite_code ? $this->invite_code->id : null;
        return [
            'code' => 'required|unique:general_invite_codes,code,'.$code.',id,deleted_at,NULL',
            'points' => 'required|integer|gt:0',
            'is_active' => 'required|in:0,1',
        ];
    }
}
