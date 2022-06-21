<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\ApiMasterRequest;
use Illuminate\Support\Str;
use App\Models\{User , GeneralInviteCode};

class SignUpRequest extends ApiMasterRequest
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
        $car_liecence_image = 'nullable|required_if:user_type,driver|image|mimes:jpeg,jpg,png';
        $health_certificate = 'nullable|image|mimes:jpeg,jpg,png';
        if ($this->health_file_type == 'file') {
            $health_certificate = 'nullable|file|mimes:pdf';
        }
        $referral_code = 'nullable|exists:general_invite_codes,code,deleted_at,NULL,is_active,1';
        if ($this->referral_code) {
            $ref_user = User::firstWhere('referral_code',$this->referral_code);
            if ($ref_user) {
                $referral_code = 'nullable|exists:users,referral_code,deleted_at,NULL';
            }
        }
        return [
            'fullname' => 'required|string|between:3,250',
            'password' => 'required|min:6',
            'email'    => 'required|email|unique:users,email',
            'phone'    => 'required|numeric|digits_between:5,20|starts_with:9665,05|unique:users,phone',
            'gender' => 'nullable|in:male,female',

            'image'    => 'nullable|image|mimes:jpg,jpeg,png',
            'country_id' => 'nullable|required_with:city_id|exists:countries,id',
            'city_id' => 'nullable|exists:cities,id',
            'user_type' => 'required|in:client,driver',
            'is_infected' => 'nullable|in:0,1',
            'health_certificate' => $health_certificate,
            // If Driver

            'brand_id' => 'nullable|required_if:user_type,driver|exists:brands,id,deleted_at,NULL',
            'car_model_id' => 'nullable|required_if:user_type,driver|exists:car_models,id,deleted_at,NULL',
            'car_type_id' => 'nullable|required_if:user_type,driver|exists:car_types,id,deleted_at,NULL',
            'package_id' => 'nullable|required_if:user_type,driver|exists:packages,id,deleted_at,NULL',

            'identity_number' => 'nullable|required_if:user_type,driver|numeric|digits_between:5,25|unique:users,identity_number',
            'date_of_birth' => 'nullable|required_if:user_type,driver|date|before:'.date("Y-m-d"),
            'date_of_birth_hijri' => 'nullable|required_if:user_type,driver|date|date_format:Y-m-d',
            // 'driver_id' => 'required_if:user_type,driver|exists:users,id,deleted_at,NULL',

            'car_licence_image' => $car_liecence_image,
            'car_form_image' => $car_liecence_image,
            'car_front_image' => $car_liecence_image,
            'car_back_image' => $car_liecence_image,
            'car_insurance_image' => $car_liecence_image,

            'driver_type' => 'nullable|required_if:user_type,driver|in:delivery,ride,both',
            'referral_code' => $referral_code,

            'plate_type' => 'nullable|required_if:user_type,driver|in:1,6',
            'license_serial_number' => 'nullable|required_if:user_type,driver|unique:cars,license_serial_number,NULL,id,deleted_at,NULL',
            'plate_number' => 'nullable|required_if:user_type,driver|string',
            'plate_numbers_only' => 'nullable|required_if:user_type,driver|numeric|digits_between:3,4',
            'plate_letters' => 'nullable|required_if:user_type,driver|string',
            'plate_letter_right' => 'nullable|required_if:user_type,driver|string|size:1',
            'plate_letter_middle' => 'nullable|required_if:user_type,driver|string|size:1',
            'plate_letter_left' => 'nullable|required_if:user_type,driver|string|size:1',

            'manufacture_year' => ['nullable','regex:/(^\d{4}$)/'],
        ];
    }

    public function getValidatorInstance()
    {
       $data = $this->all();
       if (isset($data['phone']) && $data['phone']) {
           $data['phone'] = filter_mobile_number($data['phone']);
       }
       if (isset($data['identity_number']) && $data['identity_number']) {
           $data['identity_number'] = convertArabicNumber($data['identity_number']);
       }
       if (isset($data['date_of_birth']) && $data['date_of_birth'] != null) {
           $data['date_of_birth'] = date('Y-m-d', strtotime($data['date_of_birth']));
       }
       if (isset($data['date_of_birth_hijri']) && $data['date_of_birth_hijri'] != null) {
           $data['date_of_birth_hijri'] = date('Y-m-d', strtotime($data['date_of_birth_hijri']));
       }
       $data['health_file_type'] = 'image';
       if (isset($data['health_certificate']) && $data['health_certificate'] != null) {
           if($data['health_certificate']->getClientMimeType() == 'application/pdf') {
               $data['health_file_type'] = 'file';
           }
       }

       $data['plate_number'] = '';
        if ((isset($data['plate_letter_right']) && $data['plate_letter_right'] != null)
            && (isset($data['plate_letter_middle']) && $data['plate_letter_middle'] != null)
            && (isset($data['plate_letter_left']) && $data['plate_letter_left'] != null)
        ) {
            $data['plate_letters'] = $data['plate_letter_right'] . ' ' . $data['plate_letter_middle'] . ' ' . $data['plate_letter_left'];
        }
        if(isset($data['plate_numbers']) && $data['plate_numbers'] != null){
            $data['plate_numbers_only'] = $data['plate_numbers'];
        }
        if(isset($data['plate_numbers_only']) && isset($data['plate_letters'])){
            $data['plate_number'] = $data['plate_letters'] . '_' . $data['plate_numbers_only'];
        }

       $this->getInputSource()->replace($data);
       return parent::getValidatorInstance();
    }

}
