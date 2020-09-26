<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostProductRequest;
use App\Models\PostProduct;
use App\Services\AddressService;
use App\Services\CityService;
use App\Services\PostProductService;
use Illuminate\Http\Request;
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
        $this->postProductService  = $postProductService;
    }


    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $recommendedPosts = PostProduct::where('is_recommended', '=', 1)->paginate(6);
        $cities= DB::table("cities")->get();

        if ($request->ajax()) {
            $params = array_except($request->all(), ['page']);
            // if there is search
            if (!empty($params)) {
                $title = $request->title;
                $ward = $request->ward;
                $price = $request->price;

                if ($title != null) {
                    // TODO add title condition
                }
                if ($ward != null) {
                    // TODO add ward condition
                }
                if ($price != 20) {
                    // if $price = 20 then dont search to save resource
                    // TODO whereBetween('price', [$min_price, $max_price])
                    $splitPrice = explode(',', $price, 2);
                    $minPrice = $splitPrice[0];
                    $maxPrice = $splitPrice[1];
                } else {
                    dd("khong can");
                }
                $posts = PostProduct::where('ward_code', $ward)->where('title', 'LIKE', '%'.$title.'%')->paginate(6);
                return view('partials.ajaxPost', compact('cities','posts', 'recommendedPosts'));
            }

            // if only pagination
            $posts = PostProduct::paginate(6);
            return view('partials.ajaxPost', compact('cities','posts', 'recommendedPosts'));
        }
        $posts = PostProduct::paginate(6);
        return view('home.index', compact('cities', 'posts', 'recommendedPosts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $data = AddressService::getAddressInformation();
        return view('post_products.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $post = $this->postProductService->getProductDetail($id);
        return view('post_products.show', compact('post'));
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
        $post = PostProduct::findOrFail($request->post_id);

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

        $post = PostProduct::findOrFail($request->post_id);
        $post->delete();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $post = PostProduct::findOrFail($request->id);
        $post->delete();

        return "deleted successfully";
    }
}
