<?php

namespace App\Http\Requests;

class UpdateProductRequest extends PostProductRequest
{
    /**
     * @return array|\string[][]
     */
    public function rules()
    {
        $rules =  parent::rules();
        $rules['city_id'] = ['nullable'];
        $rules['district_id'] = ['nullable'];
        $rules['ward_code'] = ['nullable'];
        $rules['street'] = ['nullable'];
        $rules['state'] = ['nullable'];
        $rules['images.*'] = ['nullable'];
        return $rules;

    }

}
