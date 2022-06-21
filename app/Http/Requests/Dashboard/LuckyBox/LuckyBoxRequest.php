<?php

namespace App\Http\Requests\Dashboard\LuckyBox;

use Illuminate\Foundation\Http\FormRequest;

class LuckyBoxRequest extends FormRequest
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
        $start_at = 'required|date|after_or_equal:'.date("Y-m-d");
        if ($this->lucky_box) {
            $start_at = 'required|date';
        }
        $rules=[
            'image' => 'nullable|image|mimes:png,jpg,jpeg,gif',
            'is_active'=>'required|in:0,1',
            'gift_type'=>'required|in:balance,points,other',
            'balance'=>'nullable|required_if:gift_type,balance|numeric|gte:2',
            'points'=>'nullable|required_if:gift_type,points|integer|gte:2',
            'start_at'=> $start_at,
            'end_at'=> 'required|date|after:start_at',
            'user_type' => 'required|in:client,driver,client_and_driver'
        ];
        foreach (config('translatable.locales') as $locale) {
            $rules[$locale.'.name'] = 'required|string|between:2,250';
            $rules[$locale.'.desc'] = 'nullable|required_if:gift_type,other|string|between:3,100000';
        }
        return $rules;
    }

    public function getValidatorInstance()
    {
        $data = $this->all();
        if (isset($data['start_at']) && $data['start_at'] != null) {
            $data['start_at'] = \Carbon\Carbon::parse($data['start_at'])->format("Y-m-d");
        }
        if (isset($data['end_at']) && $data['end_at'] != null) {
            $data['end_at'] =  \Carbon\Carbon::parse($data['end_at'])->format("Y-m-d");
        }

        $this->getInputSource()->replace($data);
        return parent::getValidatorInstance();
    }
}
