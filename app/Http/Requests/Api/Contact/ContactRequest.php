<?php

namespace App\Http\Requests\Api\Contact;

use App\Http\Requests\Api\ApiMasterRequest;

class ContactRequest extends ApiMasterRequest
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
        $email = 'required|email';
        $fullname = 'required|string|between:2,250';
        $phone = 'required|numeric|digits_between:5,20';
        $user_condition = null;
        if (auth('api')->check()) {
            $email = 'nullable|email';
            $fullname = 'nullable|string|between:2,250';
            $phone = 'nullable|numeric|digits_between:5,20';
            $user_condition = ','.auth('api')->user()->user_type.'_id,'.auth('api')->id();
        }
        return [
           'email' => $email,
           'fullname' => $fullname,
           'phone' => $phone,
           // 'type'    => 'required|string|between:2,250',
           'title'    => 'nullable|string|between:2,250',
           'order_id'    => 'nullable|exists:orders,id,deleted_at,NULL'.$user_condition,
           'content'    => 'required|string|between:2,10000',
        ];
    }
}
