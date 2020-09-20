<?php

namespace App\Http\Controllers;

use App\Models\PostComment;
use App\Models\PostProduct;
use Illuminate\Http\Request;

class PostCommentController extends Controller
{
    public function store(Request $request) {
        $comment = new PostComment();
        $comment->body = $request->get('comment_body');
        $comment->user()->associate($request->user());
        $post = PostProduct::find($request->get('post_id'));
        $post->comments()->save($comment);

        return back();
    }

    public function replyStore(Request $request) {
        $reply = new PostComment();
        $reply->body = $request->get('comment_body');
        $reply->user()->associate($request->user());
        $reply->parent_id = $request->get('comment_id');
        $post = PostProduct::find($request->get('post_id'));

        $post->comments()->save($reply);

        return back();

    }
}
