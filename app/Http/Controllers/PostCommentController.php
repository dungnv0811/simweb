<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCommentRequest;
use App\Http\Requests\PostReplyCommentRequest;
use App\Models\PostComment;
use App\Models\PostProduct;
use App\Services\CommentService;
use App\Services\PostProductService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostCommentController extends Controller
{

    /**
     * @var PostProductService
     */
    private $commentService;


    /**
     * PostCommentController constructor.
     * @param CommentService $commentService
     */
    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    public function store(PostCommentRequest $request) {
        $comment = new PostComment();
        $comment->body = $request->get('comment_body');
        $comment->user()->associate($request->user());
        $post = PostProduct::find($request->get('post_id'));
        $post->comments()->save($comment);
        return back();
    }

    public function replyStore(PostReplyCommentRequest $request) {
        $reply = new PostComment();
        $reply->body = $request->get('comment_body');
        $reply->user()->associate($request->user());
        $reply->parent_id = $request->get('comment_id');
        $post = PostProduct::find($request->get('post_id'));

        $post->comments()->save($reply);

        return back();

    }

    /**
     * Get list comment by product
     * @param Request $request
     * @param $id
     */
    public function index(Request $request)
    {
       $comments = $this->commentService->getCommentsByProduct($request);
       if ($comments) {
           return response($comments, Response::HTTP_OK);
       }
       return response([],Response::HTTP_NO_CONTENT);
    }
}
