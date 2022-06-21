<?php

namespace App\Http\Requests\Dashboard\AppAd;

use Illuminate\Foundation\Http\FormRequest;

class AppAdRequest extends FormRequest
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
        $ad = 'required|image|mimes:png,jpg,jpeg,gif';
        $start_at = 'required|date|after_or_equal:'.date("Y-m-d");
        $video = 'nullable|required_without:image_ar,image_en|file|mimes:mp4,mov,ogg,qt|max:20000';
        if ($this->app_ad) {
            $ad = 'nullable|image|mimes:png,jpg,jpeg,gif';
            $start_at = 'required|date';
            $video = 'nullable|file|mimes:mp4,mov,ogg,qt|max:20000';
        }

        $rules=[
            'image_ar' => $ad,
            'image_en' => $ad,
            'start_at' => $start_at,
            'is_active' => 'nullable|in:1,0',
            'end_at' => 'required|date|after:start_at',
            // 'video_url' => 'nullable|required_without:image_ar,image_en|url',
            'video_url' => $video,
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
