<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostProductRequest extends FormRequest
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
            'city_id' => ['required'],
            'district_id' => ['required'],
            'ward_code' => ['required'],
            'street' => ['required'],
            'title' => ['required'],
            'description' => ['required'],
            'state' => ['required'],
            'branch' => ['required'],
            'price' => ['required', 'max:16'],
            'images.*' => ['required', 'max:8192'],
        ];
    }

    public function attributes()
    {
       return [
           'city_id' => 'thành phố',
           'district_id' => 'quận',
           'ward_code' => 'phường / xã',
           'street' => 'tên đường',
           'title' => 'tiêu đề',
           'description' => 'mô tả',
           'state' => 'tình trạng',
           'branch' => 'hãng',
           'price' => 'giá',
           'images.*' => 'ảnh',
       ];
    }

    public function messages()
    {
        return [
            'images.*.max' => 'Truờng ảnh không thể lớn hơn 5MB'
        ];
    }



}
