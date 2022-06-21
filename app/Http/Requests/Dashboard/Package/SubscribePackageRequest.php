<?php

namespace App\Http\Requests\Dashboard\Package;

use Illuminate\Foundation\Http\FormRequest;

class SubscribePackageRequest extends FormRequest
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
            'end_at' => 'required|date',
            'is_paid' => 'required|boolean',
            'user_list' => 'nullable|array',
            'user_list.*' => 'nullable|exists:users,id,user_type,driver',
        ];

    }

    public function getValidatorInstance()
    {
        $data = $this->all();
        if (isset($data['end_at']) && $data['end_at'] != null) {
            $data['end_at'] = \Carbon\Carbon::parse($data['end_at'])->setTime(23, 59, 59)->format("Y-m-d H:i:s");
        }

        if (isset($data['is_paid']) && $data['is_paid'] == 'on') {
            $data['is_paid'] = true;
        }else{
            $data['is_paid'] = false;
        }
        $this->getInputSource()->replace($data);
        return parent::getValidatorInstance();
    }
}
