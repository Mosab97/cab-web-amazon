<?php

namespace App\Http\Requests\Dashboard\User;

use Illuminate\Foundation\Http\FormRequest;

class AddTempBalanceToAllRequest extends FormRequest
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
            'start_at'=>'required|date|after_or_equal:'.date("Y-m-d"),
            'end_at' => 'required|date|after:start_at',
        ];
    }

    public function getValidatorInstance()
    {
        $data = $this->all();
        if (isset($data['start_at']) && $data['start_at'] != null) {
            $data['start_at'] = \Carbon\Carbon::parse($data['start_at'])->format("Y-m-d H:i:s");
        }
        if (isset($data['end_at']) && $data['end_at'] != null) {
            $data['end_at'] =  \Carbon\Carbon::parse($data['end_at'])->format("Y-m-d H:i:s");
        }
        $this->getInputSource()->replace($data);
        return parent::getValidatorInstance();
    }
}
