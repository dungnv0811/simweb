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

        $posts = Post::paginate(15);

        if ($request->ajax()) {
            return view('partials.ajaxAdminPost', compact('posts'));
        }

        return view('admin.index', compact('posts'));
    }

    function approvePost(Request $request) {
        if ($request->ajax()) {
            return $request;
            // TODO update status of post duyệt bài
//            $data = array(
//                $request->column_name       =>  $request->column_value
//            );
//            DB::table('post')
//                ->where('id', $request->id)
//                ->update($data);
//            echo '<div class="alert alert-success">Data Updated</div>';
        }
    }


    function updatePost(Request $request) {
        if ($request->ajax()) {
            return $request;
            // TODO update data of post duyệt bài
//            $data = array(
//                $request->column_name       =>  $request->column_value
//            );
//            DB::table('post')
//                ->where('id', $request->id)
//                ->update($data);
//            echo '<div class="alert alert-success">Data Updated</div>';
        }
    }
}
