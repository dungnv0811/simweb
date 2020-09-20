<?php


namespace App\Services;

use App\Libraries\Traits\Image;
use App\Models\PostProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return  $param;
    }

    public function createProduct(Request $request)
    {
        $param = $request->only($this->product->getFillable());

        if($request->hasFile('images')) {
            $param['images']  = $this->upload($param['images'], config('define.image.product'));
        }
        $data = $this->handleParam($param);
        $this->product->create($data);





//
//        foreach ($request->file('images') as $key => $value) {
//
//            $imageName = time(). $key . '.' . $value->getClientOriginalExtension();
//
//            $value->move(public_path('images'), $imageName);
//
//        }


    }


}