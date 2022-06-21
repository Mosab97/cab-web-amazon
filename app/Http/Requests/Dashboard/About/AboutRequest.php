<?php

namespace App\Http\Requests\Dashboard\About;

use Illuminate\Foundation\Http\FormRequest;

class AboutRequest extends FormRequest
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
            'image' => 'nullable|image|mimes:png,jpg,jpeg',
            'hero_background' => 'nullable|image|mimes:png,jpg,jpeg',
        ];
        foreach (config('translatable.locales') as $locale) {
            $rules[$locale.'.desc'] = 'nullable|string|between:3,100000';
            $rules[$locale.'.strategy'] = 'nullable|string|between:3,100000';
            $rules[$locale.'.vision'] = 'nullable|string|between:3,100000';
            $rules[$locale.'.message'] = 'nullable|string|between:3,100000';
            $rules[$locale.'.message'] = 'nullable|string|between:3,100000';
            $rules[$locale.'.hero_intro'] = 'nullable|string|between:3,250';
        }
        return $rules;
    }
}
