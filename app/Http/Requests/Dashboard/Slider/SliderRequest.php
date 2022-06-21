<?php

namespace App\Http\Requests\Dashboard\Slider;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
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
        $slider = $this->slider ? $this->slider->id : null;
        $image = 'required|image|mimes:png,jpg,jpeg,gif';
        if ($slider) {
            $image = 'nullable|image|mimes:png,jpg,jpeg,gif';
        }
        $rules=[
            'image' => $image,
            'ordering' => 'nullable|integer|gt:0',
            'is_active' => 'required|in:0,1',
        ];
        foreach (config('translatable.locales') as $locale) {
            $rules[$locale.'.name'] = 'required|between:2,250';
            $rules[$locale.'.desc'] = 'nullable|string|between:3,100000';
        }
        return $rules;
    }


}
