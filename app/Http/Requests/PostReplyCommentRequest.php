<?php

namespace App\Http\Requests;


class PostReplyCommentRequest extends PostCommentRequest
{

    /**
     * @return array|\string[][]
     */
    public function rules()
    {
        $rules =  parent::rules();
        $rules['parent_id'] = ['required'];
        return $rules;
    }

}
