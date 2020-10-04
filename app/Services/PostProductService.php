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
        $param['slug'] = $param['title'] . '-' . time();
        $param['user_id'] = Auth::id();
        $param['short_description'] = substr($param['title'], 128);
        return $param;
    }

    public function createProduct(Request $request)
    {
        $param = $request->only($this->product->getFillable());
        if ($request->hasFile('images')) {
            $param['images'] = json_encode($this->upload($param['images'], config('define.image.product')));
        }
        $data = $this->handleParam($param);
        $this->product->create($data);
    }


    public function getProductDetail($slug)
    {

        $columns = [
            'posts.*',
            'wards.path_with_type'
        ];
        $condition = [
            'posts.slug' => $slug
        ];
        return $this->product
            ->ward()
            ->where($condition)
            ->firstOrFail($columns);

    }

    /**
     * @param Request $request
     */
    public function updateProduct(Request $request)
    {
        $param = $request->only($this->product->getFillable());
        $data = $this->handleParam($param);
        $condition = ['posts.id' => $request->get('id')];
        $this->product->where($condition)->update($data);
    }

    public function getProducts(Request $request)
    {
        $column = ['posts.*'];
        $condition = [];
            if ($request->get('title')) {
                $condition[] = ['title', 'LIKE', '%' . $request->get('title') . '%'];
            }
            if ($request->get('ward')) {
                $condition[] = ['wards.code', '=', $request->get('ward')];
            }
            if ($request->get('city')) {
                $condition[] = ['cities.code', '=', $request->get('city')];
            }
            if ($request->get('district')) {
                $condition[] = ['districts.code', '=', $request->get('district')];
            }
            if ($request->get('price') && $request->get('price') != 10) {
                // TODO whereBetween('price', [$min_price, $max_price])
                $splitPrice = explode(',', $request->get('price'), 2);
                $minPrice = $splitPrice[0]*1000;
                $maxPrice = $splitPrice[1]*1000;
                $condition[] = [
                    function($query) use ($minPrice, $maxPrice) {
                        $query->where([
                            ['price', '>=', $minPrice],
                            ['price', '<=', $maxPrice],
                        ]);

                    }
                ];
            }
        return $this->product
            ->address()
            ->where($condition)
            ->orderByDesc('posts.id')
            ->paginate(6, $column);
    }

    public function getProductSuggestion()
    {
        $condition = [
            'is_recommended' => PostProduct::IS_RECOMMEND
        ];
        return $this->product
            ->where($condition)
            ->paginate(6);
    }


}
