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
            'ward_id' => ['required'],
            'street' => ['required'],
            'title' => ['required'],
            'description' => ['required'],
            'status' => ['required'],
            'branch' => ['required'],
            'price' => ['required',],
            'images.*' => ['required'],
        ];
    }

    public function attributes()
    {
       return [
           'city_id' => 'thành phố',
           'district_id' => 'quận',
           'ward_id' => 'phường / xã',
           'street' => 'tên đường',
           'title' => 'tiêu đề',
           'description' => 'mô tả',
           'status' => 'tình trạng',
           'branch' => 'hãng',
           'price' => 'giá',
           'images.*' => 'ảnh',
       ];
    }
}
