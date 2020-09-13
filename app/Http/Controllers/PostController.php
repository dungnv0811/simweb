<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
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
        $recommendedPosts = Post::where('is_recommended', '=', 1)->paginate(6);

        if ($request->ajax()) {
            return view('partials.ajaxPost', compact('posts', 'recommendedPosts'));
        }

        return view('home.index', compact('posts', 'recommendedPosts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        if (Auth::guest()) {
            return redirect('login');
        }

        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        request()->validate([

            'title' => 'required',
            'images' => 'required',
//            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required'

        ]);



        foreach ($request->file('images') as $key => $value) {

            $imageName = time(). $key . '.' . $value->getClientOriginalExtension();

            $value->move(public_path('images'), $imageName);

        }

        $post = new Post([
            'user_id' => 1,
            'slug' => 'test',
            'title' => $request->get('title'),
            'image' => $request->get('image'),
            'short_description' => 'short description',
            'description' => $request->get('description'),
            'published' => 0
        ]);
        $post->save();

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $post = Post::find($id);

        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $post = Post::findOrFail($request->post_id);

        $post->update($request->all());

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        $post = Post::findOrFail($request->post_id);
        $post->delete();

        return back();
    }
}
