<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostCommentRequest extends FormRequest
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
        info("");
        info(request()->all());
        return [
            'comment_body' => ['required'],
            'post_id' => ['required']
        ];
    }


    public function attributes()
    {
        return [
            'comment_body' => 'bình luận'
        ];
    }
}
