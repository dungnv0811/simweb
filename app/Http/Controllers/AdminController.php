<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
//        if(!Gate::allows('isAdmin')){
//            abort(404,"Sorry, You can do this actions");
//        }

        $posts = Post::paginate(6);

        if ($request->ajax()) {
            return view('partials.ajaxAdminPost', compact('posts'));
        }

        return view('admin.index', compact('posts'));
    }
}
