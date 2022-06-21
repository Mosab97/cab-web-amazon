<?php

namespace App\Http\Requests\Dashboard\Package;

use Illuminate\Foundation\Http\FormRequest;

class SubscribeAllDriversPackageRequest extends FormRequest
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
             'extend_to' => 'required|date',
             // 'number_of_days' => 'required|integer|gt:0',
             'is_paid' => 'required|boolean',
             'user_list' => 'nullable|array',
             'user_list.*' => 'nullable|exists:users,id,user_type,driver',
         ];

     }

     public function getValidatorInstance()
     {
         $data = $this->all();
         if (isset($data['is_paid']) && $data['is_paid'] == 'on') {
             $data['is_paid'] = true;
         }else{
             $data['is_paid'] = false;
         }

         if (isset($data['extend_to']) && $data['extend_to'] != null) {
             $data['extend_to'] = \Carbon\Carbon::parse($data['extend_to'])->setTime(23, 59, 59)->format("Y-m-d H:i:s");
         }
         $this->getInputSource()->replace($data);
         return parent::getValidatorInstance();
     }
}
