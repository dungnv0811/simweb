<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\PostProduct;
use App\Services\AddressService;
use App\Services\CityService;
use App\Services\PostProductService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostProductController extends Controller
{

    /**
     * @var PostProductService
     */
    private $postProductService;


    public function __construct(PostProductService $postProductService)
    {
        $this->postProductService = $postProductService;
    }


    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $recommendedPosts = $this->postProductService->getProductSuggestion();
        $cities = DB::table("cities")->get();
        $posts = $this->postProductService->getProducts($request);
        if ($request->ajax()) {
            return view('partials.ajaxPost', compact('cities', 'posts', 'recommendedPosts'));
        }
        return view('home.index', compact('cities', 'posts', 'recommendedPosts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = AddressService::getAddressInformation();
        return view('post_products.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostProductRequest $request)
    {
        $this->postProductService->createProduct($request);
        $request->session()->flash('message', trans('common.create_success'));
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = $this->postProductService->getProductDetail($slug);
        return view('post_products.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $data = $this->postProductService->getProductDetail($slug);
        return view('post_products.edit', compact('data'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request)
    {
        $this->postProductService->updateProduct($request);

        $request->session()->flash('message', trans('common.create_success'));
        return redirect()->route('posts.index');
        return response([], Response::HTTP_NO_CONTENT);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        $post = PostProduct::findOrFail($request->post_id);
        $post->delete();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $post = PostProduct::findOrFail($request->id);
        $post->delete();

        return "deleted successfully";
    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function approvedProduct(Request $request)
    {
        if ($request->ajax()) {
            if ($this->postProductService->changeStatusProduct($request->get('id'))) {
                return response([], Response::HTTP_NO_CONTENT);
            }
        }
    }

}
