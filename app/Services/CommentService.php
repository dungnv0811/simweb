<?php


namespace App\Services;


use App\Models\PostComment;
use App\Models\PostProduct;
use Illuminate\Http\Request;

class CommentService extends BaseService
{
    /**
     * @var PostComment
     */
    private $comment;

    public function __construct(PostComment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getCommentsByProduct(Request $request)
    {
        $productId = $request->get('product');
        $condition = [
            'commentable_id' => $productId,
            'commentable_type' => "App\Models\PostProduct"
        ];
        return $this->comment->where($condition)->get();
    }

}
