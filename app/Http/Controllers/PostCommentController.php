<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCommentRequest;
use App\Http\Requests\PostReplyCommentRequest;
use App\Models\PostComment;
use App\Models\PostProduct;
use Illuminate\Http\Request;

class PostCommentController extends Controller
{

    public function getPostComment(Request $request)
    {
        if ($request->ajax()) {
            $postId = "$request->get('post_id')";
            // TODO return all comments of a post
            $comments = '';
            return view('partials.commentReply', compact('comments'));
        }
        // TODO return empty list
        return '';
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
}
