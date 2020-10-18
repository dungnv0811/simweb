<?php

namespace App\Http\Controllers;

use App\Models\PostProduct;
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
        $posts = PostProduct::orderByDesc('id')->paginate(15);
        if ($request->ajax()) {
            return view('partials.ajaxAdminPost', compact('posts'));
        }

        return view('admin.index', compact('posts'));
    }

}
