<?php

namespace App\Http\Requests\Dashboard\AppOffer;

use Illuminate\Foundation\Http\FormRequest;

class AppOfferRequest extends FormRequest
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
        $rules=[
            'image_ar' => 'nullable|image|mimes:png,jpg,jpeg,gif',
            'image_en' => 'nullable|image|mimes:png,jpg,jpeg,gif',
            'is_active' => 'nullable|in:1,0',
            'user_type' => 'required|in:client,driver,client_and_driver'
        ];
        foreach (config('translatable.locales') as $locale) {
            $rules[$locale.'.name'] = 'required|string|between:2,250';
            $rules[$locale.'.desc'] = 'nullable|string|between:3,100000';
        }
        return $rules;
    }
}
