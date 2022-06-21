<?php

namespace App\Http\Requests\Dashboard\Package;

use Illuminate\Foundation\Http\FormRequest;

class PackageRequest extends FormRequest
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
        $rules= [
            // 'package_price' => 'required|numeric|gt:0',
            'package_price' => 'nullable',
//            'commission' => 'required|numeric|gte:0',
           'duration' => 'nullable|integer',
            'commission' => 'nullable|gte:0',
            'free_duration' => 'nullable|integer|gte:0',
            'start_discount_at'=>'nullable|date|after_or_equal:'.date("Y-m-d"),
            'end_discount_at'=> 'nullable|date|after:start_discount_at',
            'is_active' => 'nullable|in:0,1',
            'is_discount_active' => 'nullable|in:0,1',
            'is_extend_active' => 'nullable|in:0,1',
            'extend_duration'=>'nullable|numeric|gte:0',
            'start_extend_at'=>'nullable|required_with:extend_duration|date|after_or_equal:'.date("Y-m-d"),
            'end_extend_at' => 'nullable|required_with:extend_duration|date|after:start_extend_at',
            'discount_percent'=>'nullable|numeric|gte:0',
        ];

        foreach (config('translatable.locales') as $locale) {
            $rules[$locale.'.name'] = 'required|string|between:2,250';
            $rules[$locale.'.desc'] = 'nullable|string|between:3,100000';
        }
        return $rules;
    }

    public function getValidatorInstance()
    {
        $data = $this->all();
        if (isset($data['start_extend_at']) && $data['start_extend_at'] != null) {
            $data['start_extend_at'] = \Carbon\Carbon::parse($data['start_extend_at'])->format("Y-m-d");
        }
        if (isset($data['end_extend_at']) && $data['end_extend_at'] != null) {
            $data['end_extend_at'] =  \Carbon\Carbon::parse($data['end_extend_at'])->format("Y-m-d");
        }
        if (isset($data['start_discount_at']) && $data['start_discount_at'] != null) {
            $data['start_discount_at'] =  \Carbon\Carbon::parse($data['start_discount_at'])->format("Y-m-d");

        }  if (isset($data['end_discount_at']) && $data['end_discount_at'] != null) {
        $data['end_discount_at'] =  \Carbon\Carbon::parse($data['end_discount_at'])->format("Y-m-d");
    }
        $this->getInputSource()->replace($data);
        return parent::getValidatorInstance();
    }

}
