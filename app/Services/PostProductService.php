<?php


namespace App\Services;

use App\Libraries\Traits\Image;
use App\Models\PostProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostProductService
{
    use Image;
    /**
     * @var PostProduct
     */
    private $product;

    public function __construct(PostProduct $product)
    {
        $this->product = $product;
    }

    private function handleParam(array $param): array
    {
        $param['price'] = floatval($param['price']);
        $param['slug'] =  $param['title'] . '-' . time();
        $param['user_id'] = Auth::id();
        $param['short_description'] = substr($param['title'],128);
        return  $param;
    }

    public function createProduct(Request $request)
    {
        $param = $request->only($this->product->getFillable());
        if($request->hasFile('images')) {
            $param['images']  = json_encode($this->upload($param['images'], config('define.image.product')));
        }
        $data = $this->handleParam($param);
        $this->product->create($data);
    }

    public function getProducts(Request $request)
    {
        if ($request->ajax()) {
            $params = $request->except(['page']);
            // if there is search
            if (!empty($params)) {
                $title = $request->title;
                $city = $request->city;
                $district = $request->district;
                $ward = $request->ward;
                $posts = PostProduct::where('title', 'LIKE', '%'.$title.'%')->paginate(6);
                return view('partials.ajaxPost', compact('cities','posts', 'recommendedPosts'));
            }

            // if only pagination
            $posts = PostProduct::paginate(6);
            return view('partials.ajaxPost', compact('cities','posts', 'recommendedPosts'));
        }
//        $recommendedPosts = PostProduct::where('is_recommended', '=', 1)->paginate(6);
        return view('home.index', compact('cities', 'posts', 'recommendedPosts'));

    }


}