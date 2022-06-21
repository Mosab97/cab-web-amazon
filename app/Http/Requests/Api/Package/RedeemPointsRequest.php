<?php

namespace App\Http\Requests\Api\Package;

use App\Http\Requests\Api\ApiMasterRequest;

class RedeemPointsRequest extends ApiMasterRequest
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
           'package_id' => 'required|exists:point_packages,id,deleted_at,NULL',
        ];
    }
}
